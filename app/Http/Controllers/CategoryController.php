<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Components\CategoryRecusive;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //use trait
    use DeleteModelTrait;
    private $category;
    private $categoryRecusive;

    public function __construct(Category $category, CategoryRecusive $categoryRecusive) //Category $category: Tao instance
    {
        //gan = $category de su dung cac phuong thuc va thuoc tinh trong Model Category
        $this->category = $category;

        //CategoryRecusive
        $this->categoryRecusive = $categoryRecusive;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Lay ra tat ca data moi nhat
        $categories = $this->category->latest()->paginate(6); // paginate(5) là: phân 5 sản phẩm trên 1 trang

        return view('admin.category.index', compact('categories'));
        //hoac
        // return view('category.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Click vao button +Them moi de hien ra form tao danh muc san pham
    public function create()
    {

        $htmlOption = $this->categoryRecusive->categoryRecursiveAdd();

        return view('admin.category.add', compact('htmlOption'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Tao danh muc san pham
    public function store(Request $request)
    {

        //Create a new category
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name) //Tach chuoi, vd:dinh    ngoc hai -> dinh-ngoc-hai
        ]);

        // Laravel Session 
        // Khi thao tác dữ liệu ở request hiện tại, trong request tiếp theo chúng ta muốn hiển thị trạng thái là đã thao tác thành công. Các dữ liệu này ở những request kế tiếp đó sẽ bị xóa đi
        // session()->flash('success', 'Tạo danh mục sản phẩm thành công');

        //Tao xong thi quay ve danh muc san pham
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $category = $this->category->find($id);

        $htmlOption = $this->categoryRecusive->categoryRecusiveEdit($category->parent_id); //Tim id cha de hien thi danh muc san pham cha


        return view('admin.category.edit', compact('category', 'htmlOption'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $category = $this->category->find($id)->update(
            [
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->name) //Tach chuoi, vd:dinh    ngoc hai -> dinh-ngoc-hai
            ]
        );

        //Cap nhat xong thi quay ve danh muc san pham
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // Cách 1: không có thông báo chọn xóa hoặc cancel
        // $delete = $this->category->find($id);
        // $delete->delete();
        //Xoa thanh cong thi quay ve danh muc san pham
        //return redirect()->route('categories.index');

        //Cách 2:
        return  $this->deleteModelTrait($id, $this->category);
    }
}
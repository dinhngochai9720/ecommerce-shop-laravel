<?php

namespace App\Http\Controllers;

use App\Components\MenuRecusive;
use App\Models\Menu;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class MenuController extends Controller
{
    //use trait
    use DeleteModelTrait;
    private $menuRecusive;
    private $menu;

    public function __construct(MenuRecusive $menuRecusive, Menu $menu) //MenuRecusive $menuRecusive :su dung duoc tat ca cac phuong thuc trong MenuRecusive
    {
        $this->menu = $menu;

        $this->menuRecusive = $menuRecusive;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // Lay ra tat ca data moi nhat
        $menus = $this->menu->latest()->paginate(6); // paginate(7) là: phân 7 sản phẩm trên 1 trang

        return view('admin.menu.index', compact('menus'));
        //hoac
        // return view('menus.index')->with('menus', $menus);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Khi click vao nut +Them moi
    public function create()
    {
        //Create a new menu
        $htmlOption = $this->menuRecusive->menuRecusiveAdd();

        return view('admin.menu.add', compact('htmlOption'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Create a new menu
        $this->menu->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name) //Tach chuoi, vd:dinh    ngoc hai -> dinh-ngoc-hai
        ]);

        //Tao xong thi quay ve danh muc san pham
        return redirect()->route('menus.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        //
        $menu = $this->menu->find($id);

        $htmlOption = $this->menuRecusive->menuRecusiveEdit($menu->parent_id); //$menu->parent_id: Tim id cha de hien thi menu cha


        return view('admin.menu.edit', compact('menu', 'htmlOption'));
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
        $menu = $this->menu->find($id)->update(
            [
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->name) //Tach chuoi, vd:dinh    ngoc hai -> dinh-ngoc-hai
            ]
        );

        //Cap nhat xong thi quay ve danh muc san pham
        return redirect()->route('menus.index');
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
        // $delete = $this->menu->find($id);
        // $delete->delete();
        //Xoa thanh cong thi quay ve danh sach menu
        //return redirect()->route('menus.index');

        //Cách 2:
        return  $this->deleteModelTrait($id, $this->menu);
    }
}
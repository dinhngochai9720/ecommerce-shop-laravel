<?php

namespace App\Http\Controllers;

use App\Components\CategoryRecusive;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Models\Category;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //use trait
    use StorageImageTrait;
    use DeleteModelTrait;

    private $categoryRecusive;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;

    private $category;




    public function __construct(Category $category, CategoryRecusive $categoryRecusive, Product $product, ProductImage $productImage, Tag $tag, ProductTag $productTag)
    {
        //CategoryRecusive
        $this->categoryRecusive = $categoryRecusive;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
        $this->productTag = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data_products = $this->product->latest()->paginate(3);
        return view('admin.product.index', compact('data_products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $htmlOption = $this->categoryRecusive->categoryRecursiveAdd();
        return view('admin.product.add', compact('htmlOption'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {

            DB::beginTransaction();
            // dd($request->tags);

            // dd($request->image_path);

            $dataProductCreate = ['name' => $request->name, 'price' => $request->price, 'content' => $request->content, 'user_id' => auth()->id(), 'category_id' => $request->category_id];

            //get storageTraitUpload method in Traits/StorageImageTrait
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product'); //feature_image_path is name of Ảnh sản phẩm
            // dd($dataUploadFeatureImage);

            //main image
            if (!empty($dataUploadFeatureImage)) {
                //if have file_name + file_path -> save in database
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }

            //insert data to products table
            $product = $this->product->create($dataProductCreate);
            // dd($product);

            //insert data to product_images (sub images)
            $array_file_image_path = $request->image_path;
            if ($request->hasFile('image_path')) {
                foreach ($array_file_image_path as $file_image_path_item) {

                    //get storageTraitUploadMultiple method in Traits/StorageImageTrait
                    $data_product_image_detail = $this->storageTraitUploadMultiple($file_image_path_item, 'product');
                    // dd($data_product_image_detail);

                    //create data in product_images_table in database
                    // $product->id: id of main image product
                    // $productImage = $this->productImage->create(['product_id' => $product->id, 'image_path' => $data_product_image_detail['file_path'], 'image_name' => $data_product_image_detail['file_name']]);
                    // images is method in Model Product
                    $product->images()->create(['image_path' => $data_product_image_detail['file_path'], 'image_name' => $data_product_image_detail['file_name']]);
                }
            }

            //insert tag to tags_table in database
            $array_tags = $request->tags;
            foreach ($array_tags as $tagItem) {

                // firstOrCreate sẽ tìm trong database sử dụng cặp column và giá trị truyền vào. Nếu model không được tìm thấy trong database thì một record mới sẽ được thêm với các attributes được truyền vào.
                // insert name for tags_table
                $tag = $this->tag->firstOrCreate(['name' => $tagItem]); //if exists name tag -> do not create name tag (do not insert name tag in database)

                //insert product_id and tag_id for product_tags
                // products table - tags table (many - many)
                // $productTag = $this->productTag->create(['product_id' => $product->id, 'tag_id' => $tag->id]);
                $tagIds[] = $tag->id; //array tagIds container tag id
            }
            $product->tags()->attach($tagIds); //tags is method in Model Product
            // dd($product);

            DB::commit();

            return redirect(route('products.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message' . $e->getMessage() . 'line' . $e->getLine());
        }
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
    public function edit($id)
    {
        //

        $product = $this->product->find($id);
        $htmlOption = $this->categoryRecusive->categoryRecusiveEdit($product->category_id); //Tim id cha de hien thi danh muc san pham cha
        return view('admin.product.edit', compact('htmlOption', 'product'));
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
        try {


            DB::beginTransaction();


            $dataProductUpdate = ['name' => $request->name, 'price' => $request->price, 'content' => $request->content, 'user_id' => auth()->id(), 'category_id' => $request->category_id];

            //get storageTraitUpload method in Traits/StorageImageTrait
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product'); //feature_image_path is name of Ảnh sản phẩm

            //main image
            if (!empty($dataUploadFeatureImage)) {
                //if have file_name + file_path -> save in database
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }

            //update data to products table
            $this->product->find($id)->update($dataProductUpdate);


            //create instance of Product Model by id
            $product = $this->product->find($id);

            //insert data to product_images (sub images)
            $array_file_image_path = $request->image_path;
            if ($request->hasFile('image_path')) {
                //delete all sub images before update
                $this->productImage->where('product_id', $id)->delete();

                foreach ($array_file_image_path as $file_image_path_item) {

                    //get storageTraitUploadMultiple method in Traits/StorageImageTrait
                    $data_product_image_detail = $this->storageTraitUploadMultiple($file_image_path_item, 'product');

                    // images is method in Model Product
                    $product->images()->create(['image_path' => $data_product_image_detail['file_path'], 'image_name' => $data_product_image_detail['file_name']]);
                }
            }

            //insert tag to tags_table in database
            $array_tags = $request->tags;
            foreach ($array_tags as $tagItem) {

                // firstOrCreate sẽ tìm trong database sử dụng cặp column và giá trị truyền vào. Nếu model không được tìm thấy trong database thì một record mới sẽ được thêm với các attributes được truyền vào.
                // insert name for tags_table
                $tag = $this->tag->firstOrCreate(['name' => $tagItem]); //if exists name tag -> do not create name tag (do not insert name tag in database)

                //insert product_id and tag_id for product_tags
                // products table - tags table (many - many)
                // $productTag = $this->productTag->create(['product_id' => $product->id, 'tag_id' => $tag->id]);
                $tagIds[] = $tag->id; //array tagIds container tag id
            }

            //if exist tag is do not add new tag === old tag to table, if new tag !== old tag -> add new tag to tags table
            $product->tags()->sync($tagIds); //tags is method in Model Product

            //Thuc hien insert data to database neu khong gap bat ky loi nao trong khối try
            DB::commit();

            return redirect(route('products.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message' . $e->getMessage() . 'line' . $e->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        return  $this->deleteModelTrait($id, $this->product);

        // try {
        //     //code...
        //     $this->product->find($id)->delete();

        //     return response()->json([
        //         'code' => 200,
        //         'message' => 'success',
        //     ], 200);
        // } catch (\Exception $e) {
        //     Log::error('Message' . $e->getMessage() . 'line' . $e->getLine());


        //     //if have error
        //     return response()->json([
        //         'code' => 500,
        //         'message' => 'fail'
        //     ], 500);
        // }
    }
}
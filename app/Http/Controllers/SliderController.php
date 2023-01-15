<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    use StorageImageTrait;
    use DeleteModelTrait;
    private $slider;
    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sliders = $this->slider->latest()->paginate(3);
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.slider.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {

        try {

            DB::beginTransaction();
            //
            $dataSliderCreate = [
                'name' => $request->name,
                'description' => $request->description,
            ];

            $dataUploadSilderImage = $this->storageTraitUpload($request, 'image_path', 'slider');

            if (!empty($dataUploadSilderImage)) {
                //if have file_name + file_path -> save in database
                $dataSliderCreate['image_name'] = $dataUploadSilderImage['file_name'];
                $dataSliderCreate['image_path'] = $dataUploadSilderImage['file_path'];
            }

            //insert data to products table
            $slider = $this->slider->create($dataSliderCreate);

            DB::commit();

            return redirect(route('sliders.index'));
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
        $slider = $this->slider->find($id);
        return view('admin.slider.edit', compact('slider'));
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
            //
            $dataSliderUpdate = [
                'name' => $request->name,
                'description' => $request->description,
            ];

            $dataUploadSilderImage = $this->storageTraitUpload($request, 'image_path', 'slider');

            if (!empty($dataUploadSilderImage)) {
                //if have file_name + file_path -> save in database
                $dataSliderUpdate['image_name'] = $dataUploadSilderImage['file_name'];
                $dataSliderUpdate['image_path'] = $dataUploadSilderImage['file_path'];
            }

            //insert data to products table
            $slider = $this->slider->find($id)->update($dataSliderUpdate);

            DB::commit();

            return redirect(route('sliders.index'));
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
        //
        return  $this->deleteModelTrait($id, $this->slider);
    }
}
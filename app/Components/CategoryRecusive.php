<?php

namespace App\Components;

use App\Models\Category;

class CategoryRecusive
{
    private $htmlOption = '';

    public function __construct()
    {
        $this->htmlOption = '';
    }


    public function categoryRecursiveAdd($parentId = 0,  $text = '')
    {

        // mac dinh parent_id ban dau = 0 va datas la lay ra menu co parent_id = 0
        $datas = Category::where('parent_id', $parentId)->get(); //SQl: select * from menu where parent_id =$parentId

        // Su dung de quy de luu danh muc san pham
        foreach ($datas as $data) {

            $this->htmlOption .= "<option  value='" . $data->id . " '>" . $text . $data->name . "</option>";

            $this->categoryRecursiveAdd($data->id, $text . '**');
        }

        return $this->htmlOption;

        //Su dung de quy lay ra cac danh muc cua Category
        // foreach ($datas as $data) {
        //     if ($data['parent_id'] == 0) {
        //         echo "<option>" . $data['name'] . "</option>";  //Lop 1

        //         foreach ($datas as $data_2) {
        //             if ($data_2['parent_id'] == $data['id']) {
        //                 echo "<option>" . $data_2['name'] . "</option>"; // Lop 2

        //                 foreach ($datas as $data_3) {
        //                     if ($data_3['parent_id'] == $data_2['id']) {
        //                         echo "<option>" . $data_3['name'] . "</option>"; // Lop 3
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }    

    }


    public function categoryRecusiveEdit($parentIdItem, $parentId = 0,  $text = '')
    {
        // mac dinh parent_id ban dau = 0 va datas la lay ra category co parent_id = 0
        $datas = Category::where('parent_id', $parentId)->get(); //SQl: select * from categories where parent_id =$parentId


        foreach ($datas as $data) {

            if ($parentIdItem == $data->id) {
                # code...
                $this->htmlOption .= "<option selected value='" . $data->id . " '>" . $text . $data->name . "</option>";
            } else {
                $this->htmlOption .= "<option value='" . $data->id . " '>" . $text . $data->name . "</option>";
            }

            $this->categoryRecusiveEdit($parentIdItem, $data->id, $text . '**');
        }
        return $this->htmlOption;
    }
}
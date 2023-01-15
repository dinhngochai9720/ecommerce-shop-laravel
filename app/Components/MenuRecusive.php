<?php


namespace App\Components;

use App\Models\Menu;

class MenuRecusive
{
    private $htmlOption;

    public function __construct()
    {
        $this->htmlOption = '';
    }


    public function menuRecusiveAdd($parentId = 0, $text = '')
    {
        // mac dinh parent_id ban dau = 0 va datas la lay ra menu co parent_id = 0
        $datas = Menu::where('parent_id', $parentId)->get(); //SQl: select * from menu where parent_id =$parentId

        foreach ($datas as $data) {

            $this->htmlOption .= "<option value='" . $data->id . " '>" . $text . $data->name . "</option>";

            $this->menuRecusiveAdd($data->id, $text . '**');
        }
        return $this->htmlOption;
    }

    public function menuRecusiveEdit($parentIdItem, $parentId = 0,  $text = '')
    {
        // mac dinh parent_id ban dau = 0 va datas la lay ra menu co parent_id = 0
        $datas = Menu::where('parent_id', $parentId)->get(); //SQl: select * from menus where parent_id =$parentId


        foreach ($datas as $data) {

            if ($parentIdItem == $data->id) {
                # code...
                $this->htmlOption .= "<option selected value='" . $data->id . " '>" . $text . $data->name . "</option>";
            } else {
                $this->htmlOption .= "<option value='" . $data->id . " '>" . $text . $data->name . "</option>";
            }

            $this->menuRecusiveEdit($parentIdItem, $data->id, $text . '**');
        }
        return $this->htmlOption;
    }
}
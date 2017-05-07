<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class DiscountController extends Controller
{
    public function getDiscount()
    {//init model
        $categoryModel = new Category();
        $productModel = new Product();

        //handle menu, (get its child levels) before throw it to the view.
        $menuLevel1 = $categoryModel->getMenuLevel1List()->result;
        if ($menuLevel1) {
            foreach ($menuLevel1 as $item) {
                //Get the list of child category, (get the children of the id=#$item->id)
                $childs
                    = $categoryModel->getCategoryByParrentId($item->id)->result;

                //use foreach-loop, to find and take more cate child, ty the parrent_id and and/
                $array = [];
                foreach ($childs as $childItem) {
                    $array[] = $childItem;
                }
                $item->children = $array;
            }
        }

        $listDiscount = $productModel->getListDiscountProduct()->result;
        return view('user.page.discount',compact('menuLevel1','listDiscount'));
    }
}

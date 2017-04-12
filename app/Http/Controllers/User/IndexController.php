<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function getIndex()
    {
        $categoryModel = new Category();
        $productModel = new Product();

        //handle menu data.
        $menuLevel1 = $categoryModel->getMenuLevel1List()->result;
        if ($menuLevel1) {

            foreach ($menuLevel1 as $item) {
                //lấy danh sách các cate con, có cha là $item->id.
                $childs
                    = $categoryModel->getCategoryByParrentId($item->id)->result;

                //tìm lấy ra id,và name của các cates con, lưu vào 1 thuộc tính của cate cha.
                $array = [];
                foreach ($childs as $childItem) {
                    $array[] = $childItem;
                }
                $item->children = $array;
            }
        }

        //get new products.
        $newProducts = $productModel->getNewProductList('DESC', 9)->result;

        //get discount products.
        $newDiscountProducts = $productModel->getDiscountProductList('DESC',
            9)->result;

        return view('user.page.home', compact([
            'categoryList',
            'newProducts',
            'newDiscountProducts',
            'menuLevel1'
        ]));
    }
}

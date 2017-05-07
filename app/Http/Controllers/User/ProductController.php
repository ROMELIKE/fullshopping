<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function getDetailProduct($id)
    {
        //init model.
        $categoryModel = new Category();
        $productModel = new Product();

        //check $id input:
        $checkId = $productModel->getProductById($id);
        if ($checkId->messageCode) {
            //handle menu data.
            $menuLevel1 = $categoryModel->getMenuLevel1List()->result;
            if ($menuLevel1) {
                foreach ($menuLevel1 as $item) {
                    //Get the list of child category, (get the children of the id=#$item->id)
                    $childs
                        = $categoryModel->getCategoryByParrentId($item->id)->result;
                    //use foreach-loop, to find and take more cate child, ty the parrent_id and and/
                    $array = [];
                    foreach ($childs as $childItem){
                        $array[] = $childItem;
                    }
                    $item->children = $array;
                }
            }
            //get this-products.
            $thisProduct = $productModel->getProductById($id)->result;

            //json decode images list.
            $thisProduct->listimg = json_decode($thisProduct->listimg);

            //get related products.
            $relatedProducts = $productModel->getRelatedProductList($id,
                $thisProduct->cate_id, 'DESC', 9)->result;

            return view('user.page.single',
                compact(['categoryList', 'thisProduct', 'relatedProducts','menuLevel1']));
        } else {
            return view('user.page.404');
        }
    }
}

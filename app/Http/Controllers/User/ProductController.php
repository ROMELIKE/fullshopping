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
        $categoryModel = new Category();
        $productModel = new Product();

        $checkId = $productModel->getProductById($id);
        //check $id input:
        if ($checkId->messageCode) {

            //handle menu data.
            $menuLevel1 = $categoryModel->getMenuLevel1List()->result;
            if ($menuLevel1) {

                foreach ($menuLevel1 as $item) {
                    //lấy danh sách các cate con, có cha là $item->id.
                    $childs
                        = $categoryModel->getCategoryByParrentId($item->id)->result;

                    //tìm lấy ra id,và name của các cates con, lưu vào 1 thuộc tính của cate cha.
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

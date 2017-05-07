<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Function: get the list product of this category.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCategory($id)
    {
        $categoryModel = new Category();

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

        $checkId = $categoryModel->getCategoryById($id);
        if ($checkId->messageCode) {
            //get the name of this category:
            $categoryName = $checkId->result->name;

            $model = new Product();
            $listProductsOfCategory = $model->getListProductsByCategoryId($id)->result;

            return view('user.page.category', compact('listProductsOfCategory','categoryName','menuLevel1'));
        } else {
            return redirect()->route('gethome')->with([
                'level' => 'danger',
                'message' => $checkId->messageCode
            ]);
        }

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CateAddRequest;
use App\Models\Category;
use DB;
use App\Http\Controllers\Controller;
use App\Business;
use League\Flysystem\Exception;

class CateController extends Controller
{
    /**
     * Function: get view add a new category.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        $model = new Category();

        //get the list of category (for choose the parrent).
        $list = $model->getCategoryList()->result;

        return view('admin.category.add', compact(['list']));
    }

    /**
     * Function: Add a new category.
     *
     * @param CateAddRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd(CateAddRequest $request)
    {
        $category = new Business\CategoryObject();

        if (isset($request->catename) && $request->catename) {
            $category->name = strip_tags(trim($request->catename));
            $category->alias
                = changeTitle(strip_tags(trim($request->catename)));
        }
        if (isset($request->parrent_id) && $request->parrent_id) {
            $category->parrent_id = $request->parrent_id;
        }else{
            $category->parrent_id = 0;
        }
        if (isset($request->status) && $request->status) {
            $category->status = 1;
        } else {
            $category->status = 0;
        }

        $category->date = date("Y-m-d H:i:s");

        //call to model to init function
        $model = new Category();
        //check category is exist?
        $check = $model->checkCategoryExist($category->name);
        if ($check->messageCode) {
            if ($result = $model->addNewCategory($category)) {
                $level = 'success';
                $message = $result->message;
            } else {
                $level = 'warning';
                $message = $result->message;
            }
        } else {
            $level = 'danger';
            $message = $check->message;
        }

        return redirect()->route('admin.cate.list')->with([
            'level' => $level,
            'message' => $message
        ]);

    }

    /**
     * Function: Get the view of the categories list.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function getList()
    {
        //get list of all category:
        $model = new Category();
        $list = $model->getCategoryList('DESC')->result;

        //mỗi 1 'parrent_id' thì đổi sang 'name' tại thuộc tính $parrent_id.
        foreach ($list as $item) {
            $item->parrent_id = $model->getCategoryById($item->parrent_id);
        }

        return view('admin.category.list', compact(['list']));
    }


    /**
     * Function: get Edit categories view.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $model = new Category();
        //check: input "$id" is exist?
        $checkId = $model->getCategoryById($id);
        if ($checkId->numberOfResult) {

            $thisCategory = $checkId->result;
            $list = $model->getCategoryList()->result;

            return view('admin.category.edit',
                compact(['list', 'thisCategory']));
        } else {
            return redirect()->route('admin.cate.list')->with([
                'level' => 'warning',
                'message' => 'This category is not exits!'
            ]);
        }
    }

    /**
     * Function: Handle Updating categories.
     * Need to optimize!!!
     *
     * @param CateAddRequest $request
     * @param                $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(CateAddRequest $request, $id)
    {
        $model = new Category();
        //Get request inputs.
        $nameInput = strip_tags(trim($request->catename));
        $nameDatabase = $model->getCategoryById($id)->result->name;

        $category = new Business\CategoryObject();

        if (isset($request->parrent_id) && $request->parrent_id) {
            $category->parrent_id = $request->parrent_id;
        } else {
            $category->parrent_id = 0;
        }
        if (isset($request->status) && $request->status) {
            $category->status = 1;
        } else {
            $category->status = 0;
        }
        if (isset($request->catename) && $request->catename) {
            $category->name = $request->catename;
            //check the admin rename this user or not.
            if ($nameInput != $nameDatabase) {
                //admin want to RENAME, update all
                $category->name = strip_tags(trim($request->catename));
                $category->alias
                    = changeTitle(strip_tags(trim($request->catename)));
            } else {
            }
        } else {
            $category->name = null;
        }
        $category->id = $id;
        //check the category updating process .
        if ($result = $model->upDateCategory($category)) {
            $level = 'success';
            $message = $result->message;

            return redirect()->route('admin.cate.list')->with([
                'level' => $level,
                'message' => $message
            ]);

        } else {
            $level = 'info';
            $message = $result->message;

            return redirect()->route('admin.cate.list')->with([
                'level' => $level,
                'message' => $message
            ]);
        }
    }

    /**
     * Function: Delete categories.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        $model = new Category();

        //check the "$id" is exist?
        if ($model->getCategoryById($id)->numberOfResult) {

            //check this category is parent_id ?

            if (!$model->checkCategoryIsParrent($id)->messageCode) {
                $level = 'warning';
                $message
                    = 'This category a parrent category, delete childrens first!';
            } else {
                //check this category have product ?
                if ($model->getProductByCateId($id)->numberOfResult) {
                    $level = 'warning';
                    $message
                        = 'This category has product, delete product first!';
                } else {
                    if ($model->deleteCategory($id)->messageCode) {
                        $level = 'success';
                        $message = 'Delete category successfully!!';
                    } else {
                        $level = 'warning';
                        $message = 'Fail to delete category!';
                    }
                }
            }
        } else {
            $level = 'warning';
            $message = 'This category is not exits!';
        }

        return redirect()->route('admin.cate.list')->with([
            'level' => $level,
            'message' => $message
        ]);
    }
}

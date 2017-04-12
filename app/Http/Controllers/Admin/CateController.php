<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CateAddRequest;
use App\Models\Category;
use DB;
use App\Http\Controllers\Controller;
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
        //lấy ra danh sách các list category (for choose the parrent).
        $model = new Category();
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
        $array = [
            'name' => strip_tags(trim($request->catename)),
            'parrent_id' => $request->parrent,
            'status' => $request->switch_field_1,
            'date' => date("Y-m-d H:i:s"),
            'alias' => changeTitle(strip_tags(trim($request->catename)))
        ];
        //gọi đến model để lưu:
        $model = new Category();
        $check = $model->checkCategoryExist($array['name']);

        if ($check->messageCode) {
            if ($result = $model->addNewCategory($array)) {
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
        //lấy ra tất cả các danh sách category.
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
        //Get request inputs.
        $name = strip_tags(trim($request->catename));
        $parrent_id = $request->parrent;
        $status = $request->switch_field_1;

        $model = new Category();
        //check the exist name: xem tên truyền vào có phải là tên của id này ko?
        if ($name == $model->getCategoryById($id)->result->name) {
            //admin does not want to RENAME.
            $array = [
                'parrent_id' => $request->parrent,
                'status' => $request->switch_field_1,
                'id' => $id
            ];
        } else {
            //admin want to RENAME, update all.
            $array = [
                'name' => strip_tags(trim($request->catename)),
                'parrent_id' => $request->parrent,
                'status' => $request->switch_field_1,
                'alias' => changeTitle(strip_tags(trim($request->catename))),
                'id' => $id
            ];
        }
        //check the category updating .
        if ($result = $model->upDateCategory($array)) {
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
                if ($model->deleteCategory($id)->messageCode) {
                    $level = 'success';
                    $message = 'Delete category successfully!!';
                } else {
                    $level = 'warning';
                    $message = 'Fail to delete category!';
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

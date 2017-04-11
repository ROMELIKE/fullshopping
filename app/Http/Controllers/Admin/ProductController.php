<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use File;

class ProductController extends Controller
{
    /**
     * Function: Show Add new product view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        $categoryModel = new Category();
        $categoryList = $categoryModel->getCategoryList()->result;

        return view('admin.product.add', compact(['categoryList']));
    }


    /**
     * Function: Handle product Adding.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd(Request $request)
    {
        dd($request->listimg);
      

        //get input variables.
        $array = [
            'name' => strip_tags(trim($request->name)),
            'alias' => changeTitle(strip_tags(trim($request->name))),
            'cate_id' => $request->catid,
            'price' => trim($request->price),
            'count' => trim($request->count),
            'description' => htmlentities(trim($request->description)),
            'status' => $request->status,
            'date' => date("Y-m-d H:i:s")
        ];

        //handle thumbnail of product:
        if (isset($request->thumbnail) && $request->thumbnail) {
            $thumbnail = $request->file('thumbnail')->getClientOriginalName();

            $thumbnailNew = $thumbnail.date("y-m-d H:i:s");

            //save image name in Array:
            $array['thumbnail'] = $thumbnail;

            //move image to appropriate Folder:
            $request->thumbnail->move('admin/images/products/', $thumbnail);
        }

        $model = new Product();

        //Save in database, get return values
        $result = $model->addProduct($array);

        if ($result->messageCode) {
            $level = 'success';
            $message = $result->message;

        } else {
            $level = 'danger';
            $message = $result->message;
        }

        return redirect()->route('admin.product.list')->with([
            'level' => $level,
            'message' => $message
        ]);
    }


    /**
     * Function: Show the product edit view.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $categoryModel = new Category();
        $productModel = new Product();
        $categoryList = $categoryModel->getCategoryList()->result;

        //check in put $id is exist ?
        $checkId = $productModel->getProductById($id);
        if ($checkId->messageCode) {
            $thisProduct = $checkId->result;

            return view('admin.product.edit',
                compact(['categoryList', 'thisProduct']));
        } else {
            return redirect()->route('admin.product.list')->with([
                'level' => 'danger',
                'message' => $checkId->message
            ]);
        }
    }

    /**
     * Function: Handle product editing.
     *
     * @param EditProductRequest $request
     * @param                    $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(EditProductRequest $request, $id)
    {
        $model = new Product();

        //get all request variable.
        $array = [
            'alias' => changeTitle(strip_tags(trim($request->name))),
            'cate_id' => $request->cate_id,
            'price' => $request->price,
            'count' => strip_tags(trim($request->count)),
            'desciption' => htmlentities($request->desciption),
            'status' => $request->status,
            'date' => date("y-m-d H:i:m"),
            'id' => $id
        ];

        //Handle  thumbnail input:
        if (isset($request->thumbnail) && $request->thumbnail) {

            $thumbnail = $request->thumbnail->getClientOriginalName();

            $thumbnailNew = $thumbnail.date("y-m-d H:i:s");

            //save image name in Array:
            $array['thumbnail'] = $thumbnail;

            //move image to appropriate Folder:
            $request->thumbnail->move('admin/images/products/', $thumbnail);

            //remove current thumbnail:
            $current_thumbnail = 'admin/images/products/'
                .$request->current_thumbnail;
            if (File::exists($current_thumbnail)) {
                File::delete($current_thumbnail);
            }
        }

        //check exist name of product.
        $thisProduct = $model->getProductById($id)->result;
        if ($thisProduct->name == strip_tags(trim($request->name))) {
            //admin do not need to re name this product
        } else {
            //admin need to re name this product
            $array['name'] = strip_tags(trim($request->name));
        }

        //save in database and check return values.
        $result = $model->updateProduct($array);
        if ($result->messageCode) {
            return redirect()->route('admin.product.list')
                ->with(['level' => 'success', 'message' => $result->message]);
        } else {
            return redirect()
                ->route('admin.product.edit', ['id' => $thisProduct->id])
                ->with(['level' => 'danger', 'message' => $result->message]);
        }
    }

    /**
     * Function: Show List product view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        $model = new Product();
        $productList = $model->getProductList('DESC')->result;

        //change 'cate_id' to 'category', to display in view.
        $categoryModel = new Category();
        foreach ($productList as $item) {
            $item->category
                = $categoryModel->getCategoryById($item->cate_id)->result->name;
        }

        return view('admin.product.list', compact(['productList']));
    }

    /**
     * Function: Delete products
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        $model = new Product();

        //check $id input, is exist ?
        $checkId = $model->getProductById($id);
        if ($checkId->messageCode) {
            $result = $model->deleteProduct($id);
            if ($result->messageCode) {
                $level = 'success';
                $message = $result->message;
            } else {
                $level = 'danger';
                $message = $result->message;
            }
        } else {
            $level = 'danger';
            $message = $checkId->message;
        }

        return redirect()
            ->route('admin.product.list')->with([
                'level' => $level,
                'message' => $message
            ]);
    }
}

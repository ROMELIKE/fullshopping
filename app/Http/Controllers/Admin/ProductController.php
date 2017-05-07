<?php

namespace App\Http\Controllers\Admin;

use App\Business\ProductObject;
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
    public function postAdd(AddProductRequest $request)
    {
        $product = new ProductObject();
        $model = new Product();

        //get input variables.
        if (isset($request->name) && $request->name) {
            $product->name= strip_tags(trim($request->name));
            $product->alias = changeTitle(strip_tags(trim($request->name)));
        }
        if (isset($request->cat_id) && $request->cat_id) {
            $product->cate_id = $request->cat_id;
        }
        if (isset($request->price) && $request->price) {
            $product->price = trim($request->price);
        }
        if (isset($request->discount) && $request->discount) {
            $product->discount = trim($request->discount);
        }
        if (isset($request->description) && $request->description) {
            $product->desciption = htmlentities(trim($request->description));
        }
        if (isset($request->status) && $request->status) {
            $product->status = 1;
        } else {
            $product->status = 0;
        }
        $product->date = date("Y-m-d H:i:s");

        //handle thumbnail of product:
        if (isset($request->thumbnail) && $request->thumbnail) {
            $thumbnail = $request->file('thumbnail')->getClientOriginalName();

            $thumbnailNew = $thumbnail.date("y-m-d H:i:s");

            //save image name in Array:
            $product->image = $thumbnail;

            //move image to appropriate Folder:
            $request->thumbnail->move('admin/images/products/', $thumbnail);
        }
        //handle list of images (detail images):
        if (isset($request->listimg) && $request->listimg) {
            $listImg = $request->listimg;

            $arrayImg = [];
            foreach ($listImg as $item) {
                //get the image name (one by one).
                $imageName = $item->getClientOriginalName();

                //move image to folder (one by one).
                $item->move('admin/images/product_list', $imageName);

                //save image in array (one by one).
                $arrayImg[] = $imageName;
            }
            //jsonning $arrayImg .
            $jsonEncodeArrayImage = json_encode($arrayImg);

            //save json in array.
            $product->listimg = $jsonEncodeArrayImage;
        }


        //Save in database, get return values
        $result = $model->addProduct($product);

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

            //handle the listimg before:
            $thisProduct->listimg = json_decode($thisProduct->listimg);

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
        $product = new ProductObject();
        $model = new Product();

        if (isset($request->name) && $request->name) {
            $product->name = strip_tags(trim($request->name));
            $product->alias = changeTitle(strip_tags(trim($request->name)));
        }
        if (isset($request->cat_id) && $request->cat_id) {
            $product->cate_id = $request->cat_id;
        }
        if (isset($request->username) && $request->username) {
            $product->username = strip_tags(trim($request->username));
        }
        if (isset($request->price) && $request->price) {
            $product->price = trim($request->price);
        }
        if (isset($request->discount) && $request->discount) {
            $product->discount = trim($request->discount);
        }
        if (isset($request->description) && $request->description) {
            $product->desciption = htmlentities(trim($request->description));
        }
        if (isset($request->status) && $request->status) {
            $product->status = 1;
        } else {
            $product->status = 0;
        }
        $product->date = date("Y-m-d H:i:s");
        $product->id = $id;
        //Handle  thumbnail input(single image):
        if (isset($request->thumbnail) && $request->thumbnail) {
            $newThumbnail = imageHandle($request->thumbnail);
            //remove current thumbnail:
            $current_thumbnail = 'admin/images/products/'
                .$request->current_thumbnail;
            if (File::exists($current_thumbnail)) {
                File::delete($current_thumbnail);
            }
            //save image name in Array:
            $product->image = $newThumbnail;
        }
        //Handle listimg input (list images):
        if (isset($request->listimg) && $request->listimg) {
            $listImg = $request->listimg;
            $arrayImg = [];
            foreach ($listImg as $item) {
                //get the image name (one by one).

                $imageName = imageHandle($item,'admin/images/product_list');

                //save image in array (one by one).
                $arrayImg[] = $imageName;

                //remove current listimg (one by one).
                $current_listimg = "admin/images/product_list/"
                    .$request->current_listimg;
                if (File::exists($current_listimg)) {
                    File::delete($current_listimg);
                }
            }
            //jsonning $arrayImg .
            $jsonEncodeArrayImage = json_encode($arrayImg);

            //save json in array.
            $product->listimg = $jsonEncodeArrayImage;
        }/*end handle listimg*/


        //check exist name of product.
        $thisProduct = $model->getProductById($id)->result;
        if ($thisProduct->name == strip_tags(trim($request->name))) {
            //admin do not need to re name this product
        } else {
            //admin need to re name this product
            $product->name = strip_tags(trim($request->name));
        }

        //save in database and check return values.
        $result = $model->updateProduct($product);
        if ($result->messageCode) {
            return redirect()->route('admin.product.list')
                ->with(['level' => 'success', 'message' => $result->message]);
        } else {
            return redirect()
                ->route('admin.product.list')
                ->with(['level' => 'info', 'message' => $result->message]);
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
            if($item->cate_id){
                $item->category
                    = $categoryModel->getCategoryById($item->cate_id)->result->name;
            }else{
                $item->category = null;
            }
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

        $thisProduct = $checkId->result;
        //delete image:
        if ($thisProduct->image) {
            $thumbnail = "admin/images/products/"
                .$thisProduct->image;
            if (File::exists($thumbnail)) {
                File::delete($thumbnail);
            }
        }
        //delete detail image:
        if ($thisProduct->listimg) {
            $listImg = json_decode($thisProduct->listimg);
            foreach ($listImg as $item) {
                $thumbnail = "admin/images/product_list/"
                    .$item;
                if (File::exists($thumbnail)) {
                    File::delete($thumbnail);
                }
            }
        }

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

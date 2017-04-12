<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\AddUserRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\User;
use DB;
use File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Function: Show the add new user view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        return view('admin.user.add');
    }


    /**
     * Function: Handle new user Adding.
     * @param AddUserRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd(AddUserRequest $request)
    {
        $array = [
            'name' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $request->avatar,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'date' => date("Y-m-d H:i:s"),
        ];
        $model = new User();
        $addNew = $model->AddNewUser($array);
        if ($addNew->messageCode) {
            $level = 'success';
            $message = $addNew->message;
        } else {
            $level = 'danger';
            $message = $addNew->message;
        }

        return redirect()->route('admin.user.list')->with([
            'level' => $level,
            'message' => $message
        ]);

    }

    /**
     * Function: Show the edit user view.
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $model = new User();
        //check "$id" input is exist?
        $checkUserId = $model->getUserById($id);
        if ($checkUserId->messageCode) {
            $thisUser = $model->getUserById($id)->result;

            return view('admin.user.edit', compact(['thisUser']));
        } else {
            return redirect()->route('admin.user.list')->with([
                'level' => 'danger',
                'message' => 'Can not find any user like that'
            ]);
        }

    }

    /**
     * Function: Handle user updating.
     *
     * @param EditUserRequest $request
     * @param                 $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(EditUserRequest $request, $id)
    {
        //get the input in a array.
        $array = [
            'name' => strip_tags(trim($request->fullname)),
            'address' => strip_tags(trim($request->address)),
            'email' => strip_tags(trim($request->email)),
            'phone' => strip_tags(trim($request->phone)),
            'status' => $request->status,
            'id' => $id
        ];

        //check avatar upload:
        if (isset($request->avatar) && $request->avatar) {
            //get imagename :
            $avatar = $request->avatar->getClientOriginalName();
            $array['avatar'] = $avatar;

            //move image to appropriate Folder:
            $request->avatar->move('admin/images/avatars/', $avatar);

            //delete current avatar if exist.
            $current_avatar = 'admin/images/avatars/'.$request->current_avatar;
            if (File::exists($current_avatar)) {
                File::delete($current_avatar);
            }
        }
        $model = new User();
        //Save in database, and get return values
        $result = $model->updateUser($array);
        if ($result->messageCode) {
            return redirect()->route('admin.user.list')->with([
                'level' => 'success',
                'message' => $result->message
            ]);
        } else {
            return redirect()->route('admin.user.list')->with([
                'level' => 'info',
                'message' => $result->message
            ]);
        }
    }

    public function postEditChangepassword(ChangePasswordRequest $request)
    {

    }

    /**
     * Function: Show the LIST simple-user view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        $model = new User();
        $listUser = $model->getListUser('DESC')->result;

        return view('admin.user.list', compact(['listUser']));
    }

    /**
     * Function: Show the LIST admin view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListAdmin()
    {
        $model = new User();
        $listUser = $model->getListUser('DESC', 'admin')->result;

        return view('admin.user.listadmin', compact(['listUser']));
    }


    /**.
     * Function: Handle deleting user.
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        $model = new User();

        //check the $id input is exist ?
        $checkId = $model->getUserById($id);
        if ($checkId->messageCode) {
            $result = $model->deleteUser($id);

            //check delete progress:
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

        return redirect()->route('admin.user.list')->with([
            'level' => $level,
            'message' => $message
        ]);
    }
}

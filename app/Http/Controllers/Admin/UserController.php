<?php

namespace App\Http\Controllers\Admin;

use App\Business\UserObject;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\User;
use DB;
use File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    /**
     * Function: Show the add new user view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        return view('admin.user.add');
    }


    /**
     * Function: Handle new user Adding.
     *
     * @param AddUserRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd(AddUserRequest $request)
    {
        //get input in $array:
        $user = new UserObject();
        if (isset($request->fullname) && $request->fullname) {
            $user->name = $request->fullname;
        }
        if (isset($request->username) && $request->username) {
            $user->username = $request->username;
        }
        if (isset($request->email) && $request->email) {
            $user->email = $request->email;
        }
        if (isset($request->password) && $request->password) {
            $user->password = Hash::make($request->password);
        }
        if (isset($request->phone) && $request->phone) {
            $user->phone = $request->phone;
        }
        if (isset($request->address) && $request->address) {
            $user->address = $request->address;
        }
        if (isset($request->status) && $request->status) {
            $user->status = 1;
        } else {
            $user->status = 0;
        }
        $user->date = date("Y-m-d H:i:s");

        //Handle avatar upload:
        if (isset($request->avatar) && $request->avatar) {
            $avatar = imageHandle($request->avatar,'admin/images/avatars/');

            $user->avatar = $avatar;
        }

        $model = new User();
        $addNew = $model->AddNewUser($user);
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
     *
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
        $user = new UserObject();

        //get the input in a $user.
        if (isset($request->fullname) && $request->fullname) {
            $user->name = $request->fullname;
        }
        if (isset($request->email) && $request->email) {
            $user->email = $request->email;
        }
        if (isset($request->phone) && $request->phone) {
            $user->phone = $request->phone;
        }
        if (isset($request->address) && $request->address) {
            $user->address = $request->address;
        }
        if (isset($request->status) && $request->status) {
            $user->status = 1;
        } else {
            $user->status = 0;
        }
        $user->id = $id;

        /*Explaint:
        -when admin edit the simple-user-status to "0",
        excute: log this user out of system any way(simple user).
        -admin canot set his status to "0"
        */
        if (!$request->status) {
            if (Auth::guard('simpleUser')->check()
                && Auth::guard('simpleUser')->user()['id'] == $id
            ) {
                Auth::guard('simpleUser')->logout();
            } elseif (Auth::user()['id'] == $id) {
                return redirect()->back()->with([
                    'level' => 'danger',
                    'message' => 'Don\'t set your \'status\' off, you can be logout'
                ]);
            }
        }

        //Handle avatar upload:
        if (isset($request->avatar) && $request->avatar) {
            //get imagename :
            $avatar = imageHandle($request->avatar,'admin/images/avatars/');
            $user->avatar = $avatar;
            //delete current avatar if exist.
            $current_avatar = 'admin/images/avatars/'.$request->current_avatar;
            if (File::exists($current_avatar)) {
                File::delete($current_avatar);
            }
        }

        $model = new User();
        //Save in database, and get return values
        $result = $model->updateUser($user);
        if ($result->messageCode) {
            $level = 'success';
            $message = $result->message;
        } else {
            $level = 'info';
            $message = $result->message;
        }

        return redirect()->back()->with([
            'level' => $level,
            'message' => $message
        ]);
    }

    public function postEditChangepassword(ChangePasswordRequest $request, $id)
    {
        $user = new UserObject();

        $user->password = Hash::make($request->newpw);
        $user->id = $id;

        $model = new User();
        $result = $model->updateUser($user);

        if ($result->messageCode) {
            $level = 'success';
            $message = $result->message;
        } else {
            $level = 'danger';
            $message = $result->message;
        }

        return redirect()->back()->with([
            'level' => $level,
            'message' => $message
        ]);
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
     * Function: Show the LIST admin, and throw it to view.
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
     *
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

            //check the role for supper admin can delete admin.
            //admin, super admin can delete simple customer.
            //admin can not delete another admin.

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

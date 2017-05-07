<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller
{
    /**
     * Function: Show Dashboard view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDashboard()
    {
        $contactModel = new Contact();
        $notReadContact = $contactModel->getNotReadContact();
        return view('admin.dashboard.dashboard',compact('notReadContact'));
    }

    /**
     * Function: handle logout.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getLogout()
    {
        Auth::logout();

        return redirect()->route('getlogin');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewController extends Controller
{
    public function getList()
    {
        return view('admin.news.list');
    }
    public function getAdd()
    {
        return view('admin.news.add');
    }
    public function postAdd()
    {

    }
    public function getEdit($id)
    {

        return view('admin.news.edit');
    }
    public function postEdit($id)
    {

    }
    public function deleteNew($id)
    {

    }
}

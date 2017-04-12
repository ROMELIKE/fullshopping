<?php

//ROUTE FOR USER:
Route::get('/',['as'=>'gethome','uses'=>'User\IndexController@getIndex']);
Route::get('product/{id}',['as'=>'productDetail','uses'=>'User\ProductController@getDetailProduct']);

//USER LOGIN:
Route::get('login',['as'=>'usergetlogin','uses'=>'User\LoginController@getLogin']);
Route::post('login',['as'=>'userpostlogin','uses'=>'User\LoginController@postLogin']);

//USER REGISTER:
Route::get('register',['as'=>'usergetregister','uses'=>'User\RegisterController@getRegister']);
Route::post('register',['as'=>'userpostregister','uses'=>'User\RegisterController@postRegister']);

//USER SEE CATEGORY PAGE:
Route::get('getcategory',['as'=>'usergetcategory','uses'=>'User\CategoryController@getCategory']);


//ROUTE FOR ADMIN:
Route::group(['prefix'=>'admin'],function (){
    Route::get('login',['as'=>'getlogin','uses'=>'Auth\LoginController@getLogin']);
    Route::post('login',['as'=>'postlogin','uses'=>'Auth\LoginController@postLogin']);
    Route::get('logout',['as'=>'getlogout','uses'=>'Admin\DashboardController@getLogout']);

    //nhóm 1 group chung 1 middleware.
    Route::get('dashboard',['as'=>'admin.dashboard','uses'=>'Admin\DashboardController@getDashboard']);

    Route::group(['prefix'=>'cate'],function(){
       Route::get('add',['as'=>'admin.cate.add','uses'=>'Admin\CateController@getAdd']);
       Route::post('add',['as'=>'admin.cate.add','uses'=>'Admin\CateController@postAdd']);
       Route::get('list',['as'=>'admin.cate.list','uses'=>'Admin\CateController@getList']);
       Route::get('delete/{id}',['as'=>'admin.cate.delete','uses'=>'Admin\CateController@getDelete'])->where('id', '[0-9]+');
       Route::get('edit/{id}',['as'=>'admin.cate.edit','uses'=>'Admin\CateController@getEdit'])->where('id', '[0-9]+');
       Route::post('edit/{id}',['as'=>'admin.cate.edit','uses'=>'Admin\CateController@postEdit'])->where('id', '[0-9]+');
   });
    Route::group(['prefix'=>'user'],function (){
        //Manager simple User:
        Route::get('add',['as'=>'admin.user.add','uses'=>'Admin\UserController@getAdd']);
        Route::post('add',['as'=>'admin.user.add','uses'=>'Admin\UserController@postAdd']);
        Route::get('list',['as'=>'admin.user.list','uses'=>'Admin\UserController@getList']);
        Route::get('delete/{id}',['as'=>'admin.user.delete','uses'=>'Admin\UserController@getDelete'])->where('id', '[0-9]+');
        Route::get('edit/{id}',['as'=>'admin.user.edit','uses'=>'Admin\UserController@getEdit'])->where('id', '[0-9]+');
        Route::post('edit/{id}',['as'=>'admin.user.edit','uses'=>'Admin\UserController@postEdit'])->where('id', '[0-9]+');
        Route::post('edit-changepassword/{id}',['as'=>'admin.user.edit_changepassword','uses'=>'Admin\UserController@postEditChangepassword'])->where('id', '[0-9]+');
        //Manage Administrator:
        Route::get('list-admin',['as'=>'admin.user.listadmin','uses'=>'Admin\UserController@getListAdmin']);
    });
    Route::group(['prefix'=>'product'],function (){
        //Manager simple User:
        Route::get('add',['as'=>'admin.product.add','uses'=>'Admin\ProductController@getAdd']);
        Route::post('add',['as'=>'admin.product.add','uses'=>'Admin\ProductController@postAdd']);
        Route::get('list',['as'=>'admin.product.list','uses'=>'Admin\ProductController@getList']);
        Route::get('delete/{id}',['as'=>'admin.product.delete','uses'=>'Admin\ProductController@getDelete'])->where('id', '[0-9]+');
        Route::get('edit/{id}',['as'=>'admin.product.edit','uses'=>'Admin\ProductController@getEdit'])->where('id', '[0-9]+');
        Route::post('edit/{id}',['as'=>'admin.product.edit','uses'=>'Admin\ProductController@postEdit'])->where('id', '[0-9]+');
    });
});

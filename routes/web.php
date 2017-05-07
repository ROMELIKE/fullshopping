<?php

/**
 * *************************************************************************************
 * ********************          ROUTE FOR USER PAGES:         **************************
 * *************************************************************************************
 */
Route::pattern('id', '[0-9]+');

//ROUTE FOR USER:
Route::get('/',['as'=>'gethome','uses'=>'User\IndexController@getIndex']);
Route::get('product/{id}',['as'=>'productDetail','uses'=>'User\ProductController@getDetailProduct']);

//USER SEE CATEGORY PAGE:
Route::get('getcategory/{id}',['as'=>'usergetcategory','uses'=>'User\CategoryController@getCategory']);

//OTHERPAGE:
Route::get('about',['as'=>'about','uses'=>'User\AboutController@getAbout']);

//LASTEST:
route::get('lastest', ['as' => 'lastest', 'uses' => 'User\LastestController@getLastest']);

//POPULAR:
route::get('popular', ['as' => 'popular', 'uses' => 'User\PopularController@getPopular']);

//DISCOUNT:
route::get('discount', ['as' => 'discount', 'uses' => 'User\DiscountController@getDiscount']);

//USER CONTACT:
Route::get('contact',['as'=>'getcontact','uses'=>'User\ContactController@getContact']);
Route::post('contact',['as'=>'postcontact','uses'=>'User\ContactController@postContact']);

//USER LOGIN:
Route::group(['middleware'=>'UserRouteMiddleware'],function(){
    Route::get('login',['as'=>'usergetlogin','uses'=>'User\LoginController@getLogin']);
    Route::post('login',['as'=>'userpostlogin','uses'=>'User\LoginController@postLogin']);

//USER REGISTERS:
    Route::get('register',['as'=>'usergetregister','uses'=>'User\RegisterController@getRegister']);
    Route::post('register',['as'=>'userpostregister','uses'=>'User\RegisterController@postRegister']);
});

Route::get('userlogout',['as'=>'simpleUserLogout','uses'=>'User\IndexController@getLogout']);

//USER SHOPPING CARTS:
Route::get('shopping/{id}',['as'=>'getshopping','uses'=>'User\ShoppingController@Shopping']);

//USER USES CARTS:
Route::get('cart',['as'=>'getcart','uses'=>'User\CartController@getCart']);
Route::get('deletecart/{rowId}', ['as' => 'deletecart', 'uses' => 'User\CartController@deleteCart']);
Route::get('deleteall', ['as' => 'deleteall', 'uses' => 'User\CartController@deleteAll']);
Route::post('updatecart/{rowid}', ['as' => 'updatecart', 'uses' => 'User\CartController@updateCart']);

//USER CHECKOUTS:
Route::get('checkout',['as'=>'getcheckout','uses'=>'User\CheckoutController@getCheckout']);
Route::post('checkout',['as'=>'postcheckout','uses'=>'User\CheckoutController@postCheckout']);

//ROUTE FOR ADMIN LOGIN:
Route::get('lr-admin',['as'=>'getlogin','uses'=>'Auth\LoginController@getLogin']);
Route::post('lr-admin',['as'=>'postlogin','uses'=>'Auth\LoginController@postLogin']);
Route::get('logout',['as'=>'getlogout','uses'=>'Admin\DashboardController@getLogout']);

Route::any('{all?}','User\IndexController@getIndex')->where('all','(.)');

/**
 * *************************************************************************************
 * ********************          ROUTE FOR ADMIN PAGES:         ************************
 * *************************************************************************************
 */

Route::group(['prefix'=>'admin','middleware'=>['AdminRouteMiddleware']],function (){
    Route::get('dashboard',['as'=>'admin.dashboard','uses'=>'Admin\DashboardController@getDashboard']);
        //Manager simple Categories:
    Route::group(['prefix'=>'cate'],function(){
       Route::get('add',['as'=>'admin.cate.add','uses'=>'Admin\CateController@getAdd']);
       Route::post('add',['as'=>'admin.cate.add','uses'=>'Admin\CateController@postAdd']);
       Route::get('list',['as'=>'admin.cate.list','uses'=>'Admin\CateController@getList']);
       Route::get('delete/{id}',['as'=>'admin.cate.delete','uses'=>'Admin\CateController@getDelete'])->where('id', '[0-9]+');
       Route::get('edit/{id}',['as'=>'admin.cate.edit','uses'=>'Admin\CateController@getEdit'])->where('id', '[0-9]+');
       Route::post('edit/{id}',['as'=>'admin.cate.edit','uses'=>'Admin\CateController@postEdit'])->where('id', '[0-9]+');
   });
    Route::group(['prefix'=>'user'],function (){
        //Manager simple Users:
        Route::get('add',['as'=>'admin.user.add','uses'=>'Admin\UserController@getAdd']);
        Route::post('add',['as'=>'admin.user.add','uses'=>'Admin\UserController@postAdd']);
        Route::get('list',['as'=>'admin.user.list','uses'=>'Admin\UserController@getList']);
        Route::get('delete/{id}',['as'=>'admin.user.delete','uses'=>'Admin\UserController@getDelete'])->where('id', '[0-9]+');
        Route::get('edit/{id}',['as'=>'admin.user.edit','uses'=>'Admin\UserController@getEdit'])->where('id', '[0-9]+');
        Route::post('edit/{id}',['as'=>'admin.user.edit','uses'=>'Admin\UserController@postEdit'])->where('id', '[0-9]+');

        Route::post('edit-changepassword/{id}',['as'=>'admin.user.edit_changepassword','uses'=>'Admin\UserController@postEditChangepassword'])->where('id', '[0-9]+');
        //Manage Administrators:
        Route::get('list-admin',['as'=>'admin.user.listadmin','uses'=>'Admin\UserController@getListAdmin']);
    });
    Route::group(['prefix'=>'product'],function (){
        //Manager Products:
        Route::get('add',['as'=>'admin.product.add','uses'=>'Admin\ProductController@getAdd']);
        Route::post('add',['as'=>'admin.product.add','uses'=>'Admin\ProductController@postAdd']);
        Route::get('list',['as'=>'admin.product.list','uses'=>'Admin\ProductController@getList']);
        Route::get('delete/{id}',['as'=>'admin.product.delete','uses'=>'Admin\ProductController@getDelete'])->where('id', '[0-9]+');
        Route::get('edit/{id}',['as'=>'admin.product.edit','uses'=>'Admin\ProductController@getEdit'])->where('id', '[0-9]+');
        Route::post('edit/{id}',['as'=>'admin.product.edit','uses'=>'Admin\ProductController@postEdit'])->where('id', '[0-9]+');
    });
    //Config things
    Route::group(['prefix'=>'config'],function (){
        //Manager Menu:
        Route::get('menu',['as'=>'config.menu','uses'=>'Admin\MenuController@getMenu']);
    });
    //Manager Medias:
    Route::group(['prefix'=>'media'],function (){
        Route::get('list',['as'=>'media.list','uses'=>'Admin\MediaController@getList']);
    });
    //Manager Contacts:
    Route::group(['prefix'=>'contact'],function (){
        Route::get('list',['as'=>'contact.list','uses'=>'Admin\ContactController@getList']);
        Route::get('delete/{id}',['as'=>'contact.delete','uses'=>'Admin\ContactController@deleteContact']);
        Route::get('update/{id}',['as'=>'contact.update','uses'=>'Admin\ContactController@updateContact']);
        Route::get('write',['as'=>'contact.write','uses'=>'Admin\ContactController@getWriteContact']);
    });
    //Manage Transactions:
    Route::group(['prefix'=>'transaction'],function (){
        Route::get('list',['as'=>'transaction.list','uses'=>'Admin\TransactionController@getList']);
        Route::get('delete/{id}',['as'=>'transaction.delete','uses'=>'Admin\TransactionController@deleteTransaction']);
        Route::get('update/{id}',['as'=>'transaction.update','uses'=>'Admin\TransactionController@updateTransaction']);
    });
    //Manage Order:
    Route::group(['prefix'=>'order'],function (){
        Route::get('list/{id}',['as'=>'order.list','uses'=>'Admin\OrderController@getList']);
        Route::get('delete/{id}',['as'=>'order.delete','uses'=>'Admin\OrderController@deleteOrder']);
        Route::get('update/{id}',['as'=>'order.update','uses'=>'Admin\OrderController@updateOrder']);
    });
    //Manage News:
    Route::group(['prefix'=>'new'],function (){
        Route::get('list',['as'=>'list.new','uses'=>'Admin\NewController@getList']);
        Route::get('add',['as'=>'get.add.new','uses'=>'Admin\NewController@getAdd']);
        Route::post('add',['as'=>'post.add.new','uses'=>'Admin\NewController@postAdd']);
        Route::get('delete/{id}',['as'=>'delete.new','uses'=>'Admin\NewController@deleteNew']);
        Route::get('edit/{id}',['as'=>'get.edit.new','uses'=>'Admin\NewController@getEdit']);
        Route::post('edit/{id}',['as'=>'post.edit.new','uses'=>'Admin\NewController@postEdit']);
    });
});


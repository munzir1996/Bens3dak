<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
    
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//User
Route::resource('users', 'User\UserController', ['except' => ['create', 'edit'] ]);
Route::resource('users.complains', 'User\UserComplainController', ['only' => ['index'] ]);
Route::resource('users.orders', 'User\UserOrderController', ['only' => ['index'] ]);

//Adviser
Route::resource('advisers', 'Adviser\AdviserController', ['except' => ['create', 'edit'] ]);
Route::resource('advisers.orders', 'Adviser\AdviserOrderController', ['only' => ['index'] ]);

//Manager
Route::resource('managers', 'Manager\ManagerController', ['except' => ['create', 'edit'] ]);

//Section
Route::resource('sections', 'Section\SectionController', ['except' => ['create', 'edit'] ]);
Route::resource('sections.categories', 'Section\SectionCategoryController', ['only' => ['index'] ]);

//Categories
Route::resource('categories', 'Category\CategoryController', ['except' => ['create', 'edit'] ]);
Route::resource('categories.orders', 'Category\CategoryOrderController', ['only' => ['index'] ]);

//Complain
Route::resource('complains', 'Complain\ComplainController', ['only' => ['index', 'store', 'show'] ]);

//Order
Route::resource('orders', 'Order\OrderController', ['except' => ['create', 'edit'] ]);
Route::resource('orders.adviserpictures', 'Order\OrderAdviserPictureController', ['only' => ['index'] ]);
Route::resource('orders.userpictures', 'Order\OrderUserPictureController', ['only' => ['index'] ]);

//Rate
Route::resource('rates', 'Rate\RateController', ['except' => ['create', 'edit'] ]);
Route::resource('rates.orders', 'Rate\RateOrderController', ['only' => ['index'] ]);

// AdviserPicture
Route::resource('adviserpictures', 'AdviserPicture\AdviserPictureController', ['except' => ['create', 'edit', 'update', 'destroy'] ]);

// UserPicture
Route::resource('userpictures', 'UserPicture\UserPictureController', ['except' => ['create', 'edit', 'update', 'destroy'] ]);


<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
    //     return view('welcome');
    // });
    Route::get('/', function() {
        return redirect(route('login'));
    });
    Auth::routes(['register' => false]);
    
    Route::get('transactions/{id}/set-status', 'TransactionController@setStatus')
    ->name('transactions.status');
    Route::resource('/transactions', 'TransactionController');
    
    Route::post('/products/import_excel', 'ProductController@import_excel')->name('products.import');
    Route::get('/products/{product}/gallery', 'ProductController@gallery')->name('products.gallery');
    Route::resource('/products', 'ProductController');
    
    Route::resource('/product-galleries', 'ProductGalleryController');
    
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('/users', 'UserController')->except([
        'show'
        ]);
    Route::resource('/role', 'RoleController')->except([
        'create','show', 'edit', 'update'
        ]);
        
        
            Route::get('/users/roles/{id}', 'UserController@roles')->name('users.roles');
            Route::put('/users/roles/{id}', 'UserController@setRole')->name('users.set_role');
            Route::post('/users/permission', 'UserController@addPermission')->name('users.add_permission');
            Route::get('/users/role-permission', 'UserController@rolePermission')->name('users.roles_permission');
            Route::put('/users/permission/{role}', 'UserController@setRolePermission')->name('users.setRolePermission');
            
            
           
            
            
            
            
            
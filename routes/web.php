<?php

use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\InstagramController;
use App\Http\Controllers\ManageproductController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;


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
// Route::get('/', function () {
//     return view('index');
// });


Route::get('/',[UserController::class,'Index'])->name('index.post');
Route::get('/signup',[UserController::class,'Signup'])->name('signup.post');
Route::post('/signup-user',[UserController::class,'saveUser'])->name('save.user');
// Route::post('/county', [UserController::class,'Country']);
Route::post('/states', [UserController::class,'fetchState']);
Route::post('/cities', [UserController::class,'fetchCity']);

//craete social login route
// Route::get('auth/google', [SocialController::class, 'loginWithGoogle']);
// Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);
Route::get('google', [SocialController::class,'googleRedirect'])->name('auth/google');
Route::get('/auth/google-callback', [SocialController::class,'loginWithGoogle']);
//Facebook login route
Route::get('auth/facebook', [FacebookController::class,'redirectToFacebook'])->name('authFacebook');
Route::get('auth/facebook/callback', [FacebookController::class,'handleFacebookCallback']);
//Github login Route
Route::get('auth/github', [GithubController::class,'gitRedirect'])->name('githubLogin');
Route::get('auth/github/callback', [GithubController::class,'gitCallback']);
//Instagram login Route
Route::get('auth/instagram', [InstagramController::class,'instagramRedirect'])->name('instagramLogin');
Route::get('auth/instagram-callback', [InstagramController::class,'instagramCallback']);

Route::get('/login',[UserController::class,'Login'])->name('login.post');
Route::post('/login',[UserController::class,'LogUser'])->name('login');
Route::get('/contact',[UserController::class,'Contact'])->name('contact.post');
Route::post('/contact',[UserController::class,'getInTouch'])->name('getintouch');
Route::post('/sendmail',[UserController::class,'sendEmail'])->name('sendemail');

Route::get('imageupload',[UserController::class,'ImageUploadd'])->name('image.upload');



  //Auth::routes();
    Route::group(['middleware' => 'auth'], function(){


        Route::get('/about',[UserController::class,'About'])->name('about.post');
        Route::get('/fruit',[UserController::class,'Fruit'])->name('fruit.post');
        Route::get('/blog',[UserController::class,'Blog'])->name('blog.post');
        Route::get('/review',[UserController::class,'Review'])->name('reviewPage');

        //Manage Controller
        Route::get('/fruit_mahal',[ManageproductController::class,'FruitsMahal'])->name('fruit.mahal');
        Route::get('/category',[ManageproductController::class,'searchCategory'])->name('searchCategory');
        Route::get('/manage',[ManageproductController::class,'productPage'])->name('product.page');
        Route::post('/product_add',[ManageproductController::class,'productAdd'])->name('product.add');
        Route::get('/product_list',[ManageproductController::class,'productList'])->name('product.list');
        Route::get('/product_edit/{id}',[ManageproductController::class,'productEdit'])->name('product.edit');
        Route::post('product_update/{id}',[ManageproductController::class,'productUpdate'])->name('product.update');
        Route::get('product-delete/{id}',[ManageproductController::class,'productDelete'])->name('product.delete');
        Route::post('/productstatus',[ManageproductController::class,'productStatus'])->name('productStatus');
        Route::get('/data-table',[ManageproductController::class,'dataTable'])->name('search-table');
        Route::get('/view_product/{id}',[ManageproductController::class,'viewProduct'])->name('viewProduct');
        Route::get('cart', [ManageproductController::class,'cart'])->name('cart');
        Route::get('products',[ManageproductController::class,'products'])->name('products');
        Route::get('add-to-cart/{id}', [ManageproductController::class,'addToCart'])->name('add.to.cart');
        Route::post('update-quantity', [ManageproductController::class,'updateQuantity'])->name('updateQuantity');
        Route::delete('remove-from-cart',[ManageproductController::class,'remove'])->name('removeItem');
        Route::get('/delivery_details',[ManageproductController::class,'deliveryDetails'])->name('deliveryDetails');
        Route::post('/save_delivery_address',[ManageproductController::class,'saveDeliveryAddress'])->name('save_Delivery_Address');




        Route::get('/myprofile/{id}',[UserController::class,'Profile'])->name('profile.post');
        Route::get('profile-edit/{id}',[UserController::class,'ProfileEdit'])->name('profileedit.post');
        Route::post('update/{id}',[UserController::class,'userUpdate'])->name('update.post');
        Route::get('user-delete/{id}',[UserController::class,'userDelete'])->name('delete.post');

        Route::get('/user_list',[UserController::class,'userList'])->name('user.post');
        Route::get('/logout',[UserController::class,'logOut'])->name('logout.post');

    });

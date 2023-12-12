<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogpostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CrudController;
use App\Models\Blogpost;
use App\Models\User;
use App\Models\Category;
use App\Models\Weather;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('index');
});*/

// Route::get('/',function(){
//     return view('welcome');
// });
// Route::post('/store',[PostController::class,'store']);
// Route::get('/delete/{id}',[PostController::class,'destroy']);
// Route::get('/edit/{id}',[PostController::class,'edit']);
// Route::post('/edit/{id}',[PostController::class,'update']);

Route::get('/blogposts',[BlogpostController::class,'index']);
Route::post('/blogposts',[BlogpostController::class,'index']);

Route::get('/blogposts/aboutus', function () {
    return view('blogs.aboutus');
});


Route::get('/article/{blogpost:filename}',[BlogpostController::class,'show'])->where('something','[A-z\d\-_]+');

Route::post('/article/{blogpost:filename}/comments',[CommentController::class,'store']);

Route::post('/article/{blogpost:filename}/comments/delete',[CommentController::class,'destroy']);

Route::post('/article/{blogpost:filename}/comments/update',[CommentController::class,'update']);

Route::get('/article/{blogpost:filename}/comments/edit/{id}',[CommentController::class,'edit']);

Route::post('/article/{blogpost:filename}/replies/update',[ReplyController::class,'update']);

Route::post('/article/{blogpost:filename}/replies/delete',[ReplyController::class,'destroy']);

Route::post('/article/{blogpost:filename}/replies',[ReplyController::class,'store']);

Route::get('/blogposts/register',[AuthController::class,'create'])->middleware('guest');
Route::post('/blogposts/register',[AuthController::class,'store'])->middleware('guest');

Route::post('/blogposts/logout',[AuthController::class,'logout'])->middleware('auth');

Route::get('/blogposts/login',[AuthController::class,'login'])->middleware('guest');
Route::post('/blogposts/login',[AuthController::class,'postlogin'])->middleware('guest');

Route::post('/article/{blogpost:filename}/like',[BlogpostController::class,'Like']);
Route::post('/article/{blogpost:filename}/unlike',[BlogpostController::class,'Unlike']);

Route::get('/blogposts/create',[BlogpostController::class,'create'])->middleware('auth');
Route::post('/blogposts/create', [BlogpostController::class, 'store'])->middleware('auth');

Route::get('/article/edit/{blogpost:filename}',[BlogpostController::class,'edit'])->middleware('auth');
Route::post('/article/edit/{blogpost:filename}',[BlogpostController::class,'update'])->middleware('auth');

Route::get('/article/edit/{blogpost:filename}/{id}',[BlogpostController::class,'destroy'])->middleware('auth');

Route::get('/blogposts/profile',[UserController::class,'index'])->middleware('auth');
Route::post('/blogposts/profile',[UserController::class,'index'])->middleware('auth');

Route::get('/blogposts/profile/editprofile',[UserController::class,'edit'])->middleware('auth');
Route::post('/blogposts/profile/editprofile',[UserController::class,'update'])->middleware('auth');

Route::get('/blogposts/profile/editpassword',[UserController::class,'editpassword'])->middleware('auth');
Route::post('/blogposts/profile/editpassword',[UserController::class,'updatepassword'])->middleware('auth');

//admin routes

Route::get('/admin/category/create',[CategoryController::class,'create'])->middleware('admin');
Route::patch('/admin/category/create',[CategoryController::class,'store'])->middleware('admin');
Route::post('/admin/category/create',[CategoryController::class,'create'])->middleware('admin');



Route::get('/admin/category/create/{id}',[CategoryController::class,'destroy'])->middleware('admin');
Route::get('/admin/category/edit/{id}',[CategoryController::class,'edit'])->middleware('admin');
Route::post('/admin/category/edit/{id}',[CategoryController::class,'update'])->middleware('admin');

Route::get('/admin/users/index',[UserController::class,'admin_index'])->middleware('admin');
Route::post('/admin/users/index',[UserController::class,'admin_index'])->middleware('admin');

Route::get('/admin/users/index/{id}',[UserController::class,'destroy'])->middleware('admin');

Route::post('/admin/users/index/giveadmin/{id}',[UserController::class,'giveAdmin'])->middleware('admin');
Route::post('/admin/users/index/removeadmin/{id}',[UserController::class,'removeAdmin'])->middleware('admin');

// Route::get('/weather',function(){
//     return view('weather',[
//         'texts'=>Weather::all()
//     ]);
// });

// Route::get('/weather/{some}',function($slug){
//     return view('four',[
//         'text'=>Weather::find($slug)
//     ]);  
// })->where('some','[A-z\d\-_]+');

//all -> index ->blogs.index
//single -> show -> blogs.show
//form -> create -> blogs.create
//server store -> store -> -
//edit form -> edit -> blogs.edit
//server update -> update -> -
//server delete -> destroy -> -

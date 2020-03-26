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
// 	//echo 123;exit;
//     return view('welcome');
// });
Route::get('/hello', function () {
	echo 'chinese';
});

Route::get('/index','IndexController@index');
Route::get('/goods','IndexController@goods');
/*
Route::get('/add', function () {
	echo '<form action="/adddo" method="post">'.csrf_field().'<input type="text" name="name"><button>提交</button></form>';
});

Route::post('/adddo', function () {
	echo request()->name;
});
*/

 Route::get('/add','IndexController@add');
 Route::post('/adddo','IndexController@adddo');

//一个路由支持多种请求方式
//Route::match(['get','post'],'/add','IndexController@add');
//Route::any('/add','IndexController@add');


//路由视图
// Route::view('/add','add');
// Route::get('/add','IndexController@add');

//必填参数
// Route::get('/show/{id}/{name}',function($id,$goods_name){
// echo $id."==".$goods_name;
// });

Route::get('/show/{id}/{name}','IndexController@show');

//可选参数路由
// Route::get('/news/{id}/{name?}',function($id,$goods_name=null){
//  echo $id."==".$goods_name;
//  });
//Route::get('/news/{id?}','IndexController@news');

//正则约束
//Route::get('/news/{id?}','IndexController@news')->where('id','[0-9]+');
//Route::get('/news/{id?}','IndexController@news')->where('id','\d+');
Route::get('/cate/{id}/{name}','IndexController@cate')->where(['id','\d+','name'=>'[a-zA-Z]+']);

//品牌模块的CURd
Route::prefix('brand')->middleware('islogin')->group(function(){
	Route::get('create','BrandController@create');
	Route::post('store','BrandController@store');
	Route::get('index','BrandController@index');
	Route::get('edit/{id}','BrandController@edit');
	Route::post('update/{id}','BrandController@update');
	Route::get('destroy/{id}','BrandController@destroy');
	Route::get('checkOnly','BrandController@checkOnly');
});



//学生表
//Route::get('/student/create','StudentController@create');
Route::get('/student/create','StudentController@create');
Route::post('/student/store','StudentController@store');
Route::get('/student/index','StudentController@index');
Route::get('/student/edit/{id}','StudentController@edit');
Route::post('/student/update/{id}','StudentController@update');
Route::get('/student/destroy/{id}','StudentController@destroy');


//分类表
Route::get('/cate/create','CateController@create');
Route::post('/cate/store','CateController@store');
Route::get('/cate/index','CateController@index');
Route::get('/cate/edit/{id}','CateController@edit');
Route::post('/cate/update/{id}','CateController@update');
Route::get('/cate/destroy/{id}','CateController@destroy');

//售楼表
Route::get('/leng/create','LengController@create');
Route::post('/leng/store','LengController@store');
Route::get('/leng/index','LengController@index');

//3.10作业商品
Route::prefix('gory')->group(function(){
	Route::get('create','GoryController@create');
	Route::post('store','GoryController@store');
	Route::get('index','GoryController@index');
	Route::get('edit/{id}','GoryController@edit');
	Route::post('update/{id}','GoryController@update');
	Route::get('destroy/{id}','GoryController@destroy');

});

//图书管理表
Route::prefix('book')->group(function(){
	Route::get('create','BookController@create');
	Route::post('store','BookController@store');
	Route::get('index','BookController@index');
	Route::get('edit/{id}','BookController@edit');
	Route::post('update/{id}','BookController@update');
	Route::get('destroy/{id}','BookController@destroy');
});

//后台管理
Route::prefix('admin')->group(function(){
	Route::get('create','AdminController@create');
	Route::post('store','AdminController@store');
	Route::get('index','AdminController@index');
	Route::get('edit/{id}','AdminController@edit');
	Route::post('update/{id}','AdminController@update');
	Route::get('destroy/{id}','AdminController@destroy');
});

//新闻分类表
Route::prefix('news')->group(function(){
	Route::get('create','NewsController@create');
	Route::post('store','NewsController@store');
	Route::get('index','NewsController@index');
	Route::get('edit/{id}','NewsController@edit');
	Route::post('update/{id}','NewsController@update');
	Route::get('destroy/{id}','NewsController@destroy');
});

Route::get('login','LoginController@login');
Route::post('logindo','LoginController@logindo');


Route::get('admin','LoginController@index');
Route::get('login/index','LoginController@index')->middleware('islogin');

//周测文章
Route::prefix('article')->middleware('islogin')->group(function(){
	Route::get('create','ArticleController@create');
	Route::post('store','ArticleController@store');
	Route::get('index','ArticleController@index');
	Route::get('edit/{id}','ArticleController@edit');
	Route::post('update/{id}','ArticleController@update');
	//Route::get('destroy/{id}','ArticleController@destroy');
	Route::post('destroy/{id}','ArticleController@destroy');
});

Route::get('/','Index\IndexController@index')->name('index');
Route::get('/log','Index\LoginController@log');
Route::get('/reg','Index\LoginController@reg');
Route::get('/reg/sendSms','Index\LoginController@sendSms');
Route::post('/login_do','Index\LoginController@login_do');
Route::post('/reg/regdo','Index\LoginController@regdo');
Route::get('/reg/sendEmail','Index\LoginController@sendEmail');


Route::get('/cookie/add','Index\LoginController@addcookie');
Route::get('/cookie/get','Index\LoginController@getcookie');


Route::get('/prolist','Index\ProlistController@prolist');
Route::get('/proinfo/{id}','Index\ProinfoController@proinfo')->name('proinfo');
Route::post('/addcart','Index\ProinfoController@addcart');
Route::get('/car','Index\CarController@car')->name('cart');
Route::get('/pay/{orderid}','Index\PayController@pay');
Route::get('/success','Index\SuccessController@success');
//同步条转
Route::get('/return_url','Index\PayController@return_url');
//异步跳转
Route::post('/notify_url','Index\PayController@notify_url');




//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

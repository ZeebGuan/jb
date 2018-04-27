<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//404
Route::any('404', ['uses' => 'ActionController@error']);
Route::any('update', ['uses' => 'ActionController@update']);

Route::group(['middleware' => ['web']], function () {
    //产生验证码
    Route::get('codenum', 'AdminindexController@codenum');
    //登录
    Route::any('login', ['uses' => 'LoginController@index']);
    //退出登录
    Route::any('logout', ['uses' => 'LoginController@logout']);
    //注册
    Route::get('reg/{tuijian?}', ['uses' => 'LoginController@reg'])->where('tuijian','[0-9]+');
    //重置密码
    Route::any('resetpwd', ['uses' => 'LoginController@resetpwd']);
    //判断验证码
    Route::post('checkcode','CheckController@checkcode');
    //判断帐号或手机号是否存在
    Route::post('checkuser','CheckController@checkuser');
    //判断帐号或手机号是否存在
    Route::post('checkadminuser','CheckController@checkadminuser');
    //判断帐号或手机号是否已注册
    Route::post('checkreg','CheckController@checkreg');
    //判断登录
    Route::post('checklogin','LoginController@checklogin');
    //判断注册
    Route::post('checkreguser','LoginController@checkreguser');
    //短信验证码
    Route::get('phonecode','LoginController@phonecode');
    //客户是否存在
    Route::post('checkkehu','CheckController@checkkehu');
    //供应商是否存在
    Route::post('checkgongying','CheckController@checkgongying');



    /*   主要页面开始     */
    //会员中心首页
    Route::get('/', 'MemberController@index');
    Route::get('left','MemberController@left');
    Route::get('top','MemberController@top');
    Route::get('main','MemberController@main');
    Route::any('test', 'MemberController@test');
    Route::get('key', 'MemberController@key');
    Route::get('erweima', 'MemberController@erweima');

    //后台
    Route::get('jb_admin/','AdminindexController@index');
    Route::get('jb_admin/main','AdminindexController@main');
    Route::get('jb_admin/login','AdminindexController@login');
    Route::get('jb_admin/logout','AdminindexController@logout');
    Route::any('jb_admin/logincheck','AdminindexController@logincheck');
    Route::get('jb_admin/islogin','PowerController@islogin');
    //管理员管理
    Route::get('jb_admin/admin/{do}/{id?}','AdminuserController@admin')->where(['do' => '[a-z]+','id' => '[0-9]+']);
    Route::get('jb_admin/adminleft/{do}/{id?}','AdminuserController@adminleft')->where(['do' => '[a-z]+','id' => '[0-9]+']);
    //日志管理
    Route::get('jb_admin/action','AdminLogController@action');
    Route::get('jb_admin/log/{type}','AdminLogController@log');
    //网站配置
    Route::get('jb_admin/site/{do}/{id?}','AdminsiteController@index')->where(['do' => '[a-z]+','id' => '[0-9]+']);
    //后台执行sql语句的页面
    Route::any('jb_admin/excsql/{do?}/{id?}','AdmindosqlController@excsql')->where(['do' => '[a-z]+','id' => '[0-9]+']);
    //订单管理
    Route::any('jb_admin/order/{do}/{id?}','AdminorderController@index')->where(['do' => '[a-z]+','id' => '[0-9]+']);
    //模拟排产
    Route::any('jb_admin/moni/{do}/{id?}','AdminorderController@moni')->where(['do' => '[a-z]+','id' => '[0-9]+']);
    //订单管理
    Route::any('jb_admin/doorder/{do}/{id?}','AdminorderController@doorder')->where(['do' => '[a-z]+','id' => '[0-9]+']);
    //库存管理
    Route::any('jb_admin/product/{do}/{id?}','AdminproductController@index')->where(['do' => '[a-z]+','id' => '[0-9]+']);
    //产品系列
    Route::any('jb_admin/xilie/{do}/{id?}','AdminproductController@xilie')->where(['do' => '[a-z]+','id' => '[0-9]+']);
    //原料管理
    Route::any('jb_admin/yuanliao/{do}/{id?}','AdminproductController@yuanliao')->where(['do' => '[a-z]+','id' => '[0-9]+']);
    //绑定工序到产品
    Route::any('jb_admin/addnext/{do}/{id?}','AdminproductController@addnext')->where(['do' => '[a-z]+','id' => '[0-9]+']);
    //客户管理
    Route::any('jb_admin/kehu/{do}/{id?}','AdminkehuController@index')->where(['do' => '[a-z]+','id' => '[0-9]+']);
    //业务员管理
    Route::any('jb_admin/yewuyuan/{do}/{id?}','AdminyewuyuanController@index')->where(['do' => '[a-z]+','id' => '[0-9]+']);
    //设备管理
    Route::any('jb_admin/shebei/{do}/{id?}','AdminshebeiController@index')->where(['do' => '[a-z]+','id' => '[0-9]+']);
    //模具管理
    Route::any('jb_admin/muju/{do}/{id?}','AdminmujuController@index')->where(['do' => '[a-z]+','id' => '[0-9]+']);
    //工序管理
    Route::any('jb_admin/gongxu/{do}/{id?}','AdmingongxuController@index')->where(['do' => '[a-z]+','id' => '[0-9]+']);
    //员工管理
    Route::any('jb_admin/yuangong/{do}/{id?}','AdminyuangongController@index')->where(['do' => '[a-z]+','id' => '[0-9]+']);
    //任务管理
    Route::any('jb_admin/renwu/{do}/{id?}','AdminrenwuController@index')->where(['do' => '[a-z]+','id' => '[0-9]+']);
    //供应商管理
    Route::any('jb_admin/gongying/{do}/{id?}','AdmingongyingController@index')->where(['do' => '[a-z]+','id' => '[0-9]+']);
    //采购管理
    Route::any('jb_admin/caigou/{do}/{id?}','AdmincaigouController@index')->where(['do' => '[a-z]+','id' => '[0-9]+']);
});

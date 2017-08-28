<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    /**
     * 显示登录
     */
    public function create(){
        return view('sessions.create');

    }

    /**
     * 认证登录
     * required 来验证用户名是否为空,min和max限制用户名长度
     * email 验证邮箱是否匹配 unique: 验证唯一性
     * confirmed 验证密码两次输入是否一致
     */
    public function store(Request $request){
        $this->validate($request,[
            'email' =>'email|required|max:255',
            'password' => 'required'
        ]);
        //拼接邮箱和密码
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        /**
         * 认证用户
         * attempt 方法会接收一个数组来作为第一个参数，该参数提供的值将用于寻找数据库中的用户数据
         */
        if (Auth::attempt($credentials,$request->has('remember'))){
            //登录成功后的操作
            session()->flash('success','欢迎回来');
            return redirect()->route('users.show',[Auth::user()]);//Auth::user 获取当前登录信息
        }else{
            //登录失败后的操作
            session()->flash('danger','很抱歉,您的邮箱和密码不匹配');
            return redirect()->back();//返回上级页面
        }
        return;
    }
    //退出登录
    public function destroy(){
        Auth::logout();
        session()->flash('success','您已成功退出');
        return redirect('login');

    }
}

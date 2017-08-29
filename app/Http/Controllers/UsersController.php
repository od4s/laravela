<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use App\Http\Requests;



class UsersController extends Controller
{


    /**
     * 过滤http请求
     * 权限系统
     * 中间件
     */
    public function __construct(){
        $this->middleware('auth',[
            'except' => ['show','create','store']
        ]);
    }


    /**
     * 注册展示
     */
    public function create(){
        return view('users.create');
    }


    /**
     * 注册验证
     *
     * 一种对新手较为友好的验证方式 - validator
     * validator 由 App\Http\Controllers\Controller 类中的 ValidatesRequests 进行定义，因此我们可以在所有的控制器中使用 validate 方法来进行数据验证。
     * validate 方法接收两个参数，第一个参数为用户的输入数据，第二个参数为该输入数据的验证规则
     *
     * Request对象放置着此次请求的全部信息
     * 如 :
     * 请求方式 (get/post)
     * 请求参数 ($\_POST,$\_FILES)
     * 请求路径 ( 域名后的部分 )
     * 请求 cookie 等诸多信息 , 都存到的 Request 对象上
     */
    public function store(Request $request){
        //验证注册表单
        $this->validate($request,[
            //验证规则
            /**
             * required 来验证用户名是否为空,min和max限制用户名长度
             * email 验证邮箱是否匹配 unique: 验证唯一性
             * confirmed 验证密码两次输入是否一致
             */
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'confirmed|min:8|max:18'

        ]);

        //保存用户并重定向
        $user = User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>bcrypt($request->password),
        ]);


        /**
         * 显示注册信息
         *
         * 我们可以使用 session() 方法来访问会话实例。而当我们想存入一条缓存的数据，让它只在下一次的请求内有效时，则可以使用 flash 方法。
         * flash 方法接收两个参数，第一个为会话的键，第二个为会话的值，我们可以通过下面这行代码的为会话赋值。
         */
        session()->flash('success','欢迎,您将在这里开启一段新的旅程~');




        /**
         * 带参数跳转 redirect 跳转  route第一个参数是路由地址,第二个可以传递参数
         *
         * 用户模型 User::create() 创建成功后会返回一个用户对象，并包含新注册用户的所有信息。
         * 我们将新注册用户的所有信息赋值给变量 $user，并通过路由跳转来进行数据绑定
         */
        return redirect()->route('users.show',[$user]);


    }

    /**
     * 显示用户的个人信息
     */
    public function show(User $user){
    //        if ($user->id == Auth::user()->id){
    //            return view('users.show',compact('user'));
    //        }else{
    //            return redirect()->back();
    //        }
    //        return;
            return view('users.show',compact('user'));

    }


    /**
     * 编辑用户资料页面
     */

    public function edit(User $user){

    //        if ($user->id == Auth::user()->id){
    //
    //            return view('users.edit',compact('user'));
    //        }else{
    //            return redirect()->back();
    //        }
    //        return;
        return view('users.edit',compact('user'));

    }

    /*
     * 更改用户资料
     */
    /**
     * required 来验证用户名是否为空,min和max限制用户名长度
     * email 验证邮箱是否匹配 unique: 验证唯一性
     * confirmed 验证密码两次输入是否一致
     * nullable 可选验证
     */

    public function update(User $user,Request $request){
            //验证
            $this->validate($request,[
                'name' => 'required|min:3|max:50',
                'password' => 'nullable|min:8|confirmed',

            ]);

            $data = [];
            $data['name'] = $request->name;
            if ($request->password){
                $data['password'] = $request->password;
            }

            $user->update($data);


            session()->flash('success','个人资料更新成功!');

           return redirect()->route('users.show',[$user->id]);

    }

}

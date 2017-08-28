<?php

namespace App\Models; //修改命名空间

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable; //消息通知类功能引用
use Illuminate\Foundation\Auth\User as Authenticatable; //授权相关功能引用

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Gravatar生成用户头像
     */
    public function gravatar($size='100'){
        $hash = md5(strtolower(trim($this->attributes['email'])));
        //使用this->attributes获取用户邮箱($this=user) strlolower 转换小写 trim 取出空格 md5加密
        return "http://www.gravatar.com/avatar/$hash?s=$size";


    }

    /**
     * 指定和数据库交互的表名
     */

    protected $table='users';

    /**
     * The attributes that are mass assignable.
     * 过滤的字段
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

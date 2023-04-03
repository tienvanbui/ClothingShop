<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Blog;
use App\Models\Cart;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'avatar',
        'role_id',
        'email',
        'address',
        'phoneNumber',
        'password',
        'facebook_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
    public function setNameAttribute($val)
    {
        $this->attributes['name'] = ucwords($val);
    }
    public function setAddressAttribute($val)
    {
        $this->attributes['address'] = ucwords($val);
    }
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
    public function getUserNameAttribute($val)
    {
        return ucwords($val);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function userIsOnline()
    {
        $users = User::all();
        $userOnlined = [];
        foreach ($users as  $user) {
            if (Cache::has('user-is-online-' . $user->id)) {
                array_push($userOnlined, $user);
            }
        }
        return $userOnlined;
    }
    public function hasPermission($permission_name){
        $isHasPermission = ((auth()->user()->role)->permissions()->where('key_code',$permission_name)->first()) ? ((auth()->user()->role)->permissions()->where('key_code',$permission_name)->first())->key_code : null;
        return $isHasPermission ? true : false;
    }

}

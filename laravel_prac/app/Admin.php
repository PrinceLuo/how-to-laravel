<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Controllers\AdminController;
use App\Notifications\AdminResetPasswordNotification;
use App\role;

class Admin extends Authenticatable
{
    //
    use Notifiable;
    
    protected $table = 'admins';
    
    public function role(){
        return $this->belongsToMany(role::class, 'role_admins');
    }


    // copied from \Illuminate\Auth\Passwords\CanResetPassword.php
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }
    
    /**
     * The attributes that are mass assignable.
     *
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

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;
use Algolia\ScoutExtended\Facades\Algolia;

class User extends Authenticatable
{
    use Notifiable;
    use Searchable;

    // $searchKey = Algolia::searchKey(User::class);

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

    public function bookings(){
        return $this->hasMany('App\Bookings');
    }
}

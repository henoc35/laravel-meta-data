<?php

namespace CityHunter\LaravelMetaData\Tests\Models;

use CityHunter\LaravelMetaData\Concerns\HasUserMeta;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasUserMeta;

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

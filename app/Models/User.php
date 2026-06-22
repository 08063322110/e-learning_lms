<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class User
 * @package App\Models
 * @version May 31, 2026, 1:06 am UTC
 *
 * @property string $name
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $date_of_birth
 * @property boolean $is_subscribed
 * @property string|\Carbon\Carbon $email_verified_at
 * @property string $password
 * @property integer $view_count
 * @property integer $role_id
 * @property string $remember_token
 */
class User extends Model
{

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'name',
        'email',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'is_subscribed',
        'email_verified_at',
        'password',
        'view_count',
        'role_id',
        'remember_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'gender' => 'string',
        'date_of_birth' => 'date',
        'is_subscribed' => 'boolean',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'view_count' => 'integer',
        'role_id' => 'integer',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:191',
        'email' => 'required|string|max:191',
        'first_name' => 'required|string|max:191',
        'last_name' => 'required|string|max:191',
        'gender' => 'nullable|string|max:191',
        'date_of_birth' => 'nullable',
        'is_subscribed' => 'nullable|boolean',
        'email_verified_at' => 'nullable',
        'password' => 'required|string|max:191',
        'view_count' => 'required|integer',
        'role_id' => 'required|integer',
        'remember_token' => 'nullable|string|max:100'
    ];  

    public function role()
    {
            return $this->belongsTo('App\Models\Role');
    }

      public function courses()
    {
        return $this->belongsToMany('App\Models\Course');
    }

       public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}

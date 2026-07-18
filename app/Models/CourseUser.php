<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class CourseUser
 * @package App\Models
 * @version May 30, 2026, 11:18 am UTC
 *
 * @property integer $user_id
 * @property integer $course_id
 * @property integer $user_account_id
 * @property string|\Carbon\Carbon $paid_date
 * @property string|\Carbon\Carbon $expiry_date
 * @property string $plan
 * @property number $paid_amount
 * @property boolean $status
 */
class CourseUser extends Model
{

    public $table = 'course_user';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'user_id',
        'course_id',
        'user_account_id',
        'paid_date',
        'expiry_date',
        'plan',
        'paid_amount',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'course_id' => 'integer',
        'user_account_id' => 'integer',
        'paid_date' => 'datetime',
        'expiry_date' => 'datetime',
        'plan' => 'string',
        'paid_amount' => 'float',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|integer',
        'course_id' => 'required|integer',
        'user_account_id' => 'required|integer',
        'paid_date' => 'required',
        'expiry_date' => 'required',
        'plan' => 'nullable|string|max:191',
        'paid_amount' => 'nullable|numeric',
        'status' => 'required|boolean'
    ];
    
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function course(){
        return $this->belongsTo('App\Models\Course');
    }
}

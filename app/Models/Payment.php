<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Payment
 * @package App\Models
 * @version May 30, 2026, 11:20 am UTC
 *
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $course_id
 * @property number $amount
 * @property string $status
 * @property string $mode_of_payment
 * @property string $payment_processor
 */
class Payment extends Model
{

    public $table = 'payments';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



public $fillable = [
    'reference',
    'user_id',
    'category_id',
    'course_id',
    'amount',
    'status',
    'gateway_response',
    'mode_of_payment',
    'payment_processor'
];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    'id' => 'integer',
    'reference' => 'string',
    'user_id' => 'integer',
    'category_id' => 'integer',
    'course_id' => 'integer',
    'amount' => 'float',
    'status' => 'string',
    'gateway_response' => 'string',
    'mode_of_payment' => 'string',
    'payment_processor' => 'string'
];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|integer',
        'category_id' => 'nullable|integer',
        'course_id' => 'nullable|integer',
        'amount' => 'required|numeric',
        'status' => 'required|string|max:191',
        'mode_of_payment' => 'nullable|string|max:191',
        'payment_processor' => 'nullable|string|max:191'
    ];

    
}

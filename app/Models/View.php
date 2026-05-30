<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class View
 * @package App\Models
 * @version May 30, 2026, 11:21 am UTC
 *
 * @property integer $user_id
 * @property integer $user_account_id
 * @property integer $category_id
 * @property integer $course_id
 * @property integer $item_id
 */
class View extends Model
{

    public $table = 'views';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'user_id',
        'user_account_id',
        'category_id',
        'course_id',
        'item_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'user_account_id' => 'integer',
        'category_id' => 'integer',
        'course_id' => 'integer',
        'item_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|integer',
        'user_account_id' => 'nullable|integer',
        'category_id' => 'nullable|integer',
        'course_id' => 'nullable|integer',
        'item_id' => 'nullable|integer'
    ];

    
}

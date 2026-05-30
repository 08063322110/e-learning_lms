<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Item
 * @package App\Models
 * @version May 30, 2026, 11:19 am UTC
 *
 * @property integer $user_id
 * @property integer $course_id
 * @property integer $view_count
 * @property string $url
 * @property string $description
 */
class Item extends Model
{

    public $table = 'items';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'user_id',
        'course_id',
        'view_count',
        'url',
        'description'
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
        'view_count' => 'integer',
        'url' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'nullable|integer',
        'course_id' => 'required|integer',
        'view_count' => 'required|integer',
        'url' => 'nullable|string|max:191',
        'description' => 'nullable|string'
    ];

    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Course
 * @package App\Models
 * @version May 30, 2026, 11:17 am UTC
 *
 * @property integer $user_id
 * @property string $category_id
 * @property string $title
 * @property string $description
 * @property string $about_instructor
 * @property number $discount_price
 * @property number $actual_price
 * @property string $playlist_url
 * @property integer $view_count
 * @property integer $subscriber_count
 * @property integer $status
 * @property string $photo
 */
class Course extends Model
{

    public $table = 'courses';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'about_instructor',
        'discount_price',
        'actual_price',
        'playlist_url',
        'view_count',
        'subscriber_count',
        'status',
        'photo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'category_id' => 'string',
        'title' => 'string',
        'description' => 'string',
        'about_instructor' => 'string',
        'discount_price' => 'float',
        'actual_price' => 'float',
        'playlist_url' => 'string',
        'view_count' => 'integer',
        'subscriber_count' => 'integer',
        'status' => 'integer',
        'photo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|integer',
        'category_id' => 'required|string|max:191',
        'title' => 'required|string|max:191',
        'description' => 'required|string',
        'about_instructor' => 'required|string',
        'discount_price' => 'required|numeric',
        'actual_price' => 'required|numeric',
        'playlist_url' => 'required|string|max:191',
        'view_count' => 'required|integer',
        'subscriber_count' => 'required|integer',
        'status' => 'required|integer',
        'photo' => 'nullable|string|max:191'
    ];

    
}

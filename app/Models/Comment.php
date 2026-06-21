<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Comment
 * @package App\Models
 * @version May 30, 2026, 11:16 am UTC
 *
 * @property integer $user_id
 * @property integer $course_id
 * @property integer $category_id
 * @property string $body
 */
class Comment extends Model
{

    public $table = 'comments';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'user_id',
        'course_id',
        'category_id',
        'body'
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
        'category_id' => 'integer',
        'body' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|integer',
        'course_id' => 'nullable|integer',
        'category_id' => 'nullable|integer',
        'body' => 'required|string'
    ];

     public function course()
     {
    return $this->belongsTo('App\Models\Course');
    }
}

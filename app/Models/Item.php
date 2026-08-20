<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Item
 * @package App\Models
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
        'title',
        'type',
        'video_url',
        'file_url',
        'content',
        'order',
        'description'
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'course_id' => 'integer',
        'view_count' => 'integer',
        'url' => 'string',
        'title' => 'string',
        'type' => 'string',
        'video_url' => 'string',
        'file_url' => 'string',
        'content' => 'string',
        'order' => 'integer',
        'description' => 'string'
    ];

    public static $rules = [
        'user_id' => 'nullable|integer',
        'course_id' => 'required|integer|exists:courses,id',
        'view_count' => 'nullable|integer',
        'url' => 'nullable|string|max:191',
        'title' => 'required|string|max:191',
        'type' => 'required|string|max:50',
        'video_url' => 'nullable|string|max:191',
        'file_url' => 'nullable|string|max:191',
        'content' => 'nullable|string',
        'order' => 'nullable|integer',
        'description' => 'nullable|string'
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
}
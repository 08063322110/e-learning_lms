<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Course
 * @package App\Models
 * @version June 3, 2026, 3:44 am UTC
 *
 * @property integer $user_id
 * @property integer $category_id
 * @property string $title
 * @property string $sub_title
 * @property string $description
 * @property string $about_instructor
 * @property string $playlist_url
 * @property string $tags
 * @property string $photo
 * @property string $promo-video_url
 * @property string $creator_status
 * @property string $admin_status
 * @property string $what_will_students_learn
 * @property string $target_students
 * @property string $requirements
 * @property number $discount_price
 * @property number $actual_price
 * @property integer $view_count
 * @property integer $subscriber_count
 */

class Course extends Model
{
    use SoftDeletes;

    public $table = 'courses';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'category_id',
        'title',
        'sub_title',
        'description',
        'about_instructor',
        'playlist_url',
        'tags',
        'photo',
        'promo_video_url',
        'creator_status',
        'admin_status',
        'what_will_students_learn',
        'target_students',
        'requirements',
        'discount_price',
        'actual_price',
        'view_count',
        'subscriber_count'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'category_id' => 'integer',
        'title' => 'string',
        'sub_title' => 'string',
        'description' => 'string',
        'about_instructor' => 'string',
        'playlist_url' => 'string',
        'tags' => 'string',
        'photo' => 'string',
        'promo_video_url' => 'string',
        'creator_status' => 'string',
        'admin_status' => 'string',
        'what_will_students_learn' => 'string',
        'target_students' => 'string',
        'requirements' => 'string',
        'discount_price' => 'float',
        'actual_price' => 'float',
        'view_count' => 'integer',
        'subscriber_count' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'user_id' => 'required|integer',
        'category_id' => 'required|integer',
        'title' => 'required|string|max:191',
        'sub_title' => 'nullable|string|max:191',
        'description' => 'required|string',
        'about_instructor' => 'nullable|string',
        'playlist_url' => 'required|string|max:191',
        'tags' => 'nullable|string|max:191',
        'photo' => 'nullable|string|max:191',
        'promo_video_url' => 'nullable|string|max:191',
        'creator_status' => 'required|string|max:191',
        'admin_status' => 'required|string|max:191',
        'what_will_students_learn' => 'nullable|string',
        'target_students' => 'nullable|string',
        'requirements' => 'nullable|string',
        'discount_price' => 'required|numeric',
        'actual_price' => 'required|numeric',
        // 'view_count' => 'required|integer',
        // 'subscriber_count' => 'required|integer',
        'deleted_at' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function category(){
    return $this->belongsTo('App\Models\Category');
    }

     public function user(){
    return $this->belongsTo('App\Models\User');
    }

   public function users()
    {
        return $this->belongsToMany('App\Models\User')
        ->withPivot('paid_amount')
        ->withPivot('paid_amount')
        ->withPivot('paid_date')
        ->withPivot('expiry_date')
        ->withPivot('plan')
        ->withPivot('created_at')
        ->withPivot('user_account_id')
        ->withPivot('user_account_id')
        ;
    }

       public function comments()
    {
        return $this->hasMany('App\Models\Comment');

    } 
    
    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }
}
<?php

namespace App\Repositories;

use App\Models\Coupon;
use App\Repositories\BaseRepository;

/**
 * Class CouponRepository
 * @package App\Repositories
 * @version June 5, 2026, 2:57 am UTC
*/

class CouponRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'student_id',
        'course_id',
        'category_id',
        'user_account_id',
        'available_on_course_page',
        'type',
        'price',
        'status',
        'deadline',
        'countdown_timer',
        'total_available',
        'total_remaining'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Coupon::class;
    }
}

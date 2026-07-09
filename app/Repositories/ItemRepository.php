<?php

namespace App\Repositories;

use App\Models\Item;
use App\Repositories\BaseRepository;

/**
 * Class ItemRepository
 * @package App\Repositories
 * @version May 30, 2026, 11:19 am UTC
*/

class ItemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'course_id',
        'view_count',
        'url',
        'title',
        'description'
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
        return Item::class;
    }
}

<?php

namespace App\Repositories;

use App\Models\home;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class homeRepository
 * @package App\Repositories
 * @version January 30, 2018, 5:13 pm UTC
 *
 * @method home findWithoutFail($id, $columns = ['*'])
 * @method home find($id, $columns = ['*'])
 * @method home first($columns = ['*'])
*/
class homeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'name',
        'pc',
        'nhietdo'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return home::class;
    }
}

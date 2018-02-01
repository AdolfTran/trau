<?php

namespace App\Repositories;

use App\Models\Machine;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MachineRepository
 * @package App\Repositories
 * @version February 1, 2018, 3:37 pm UTC
 *
 * @method Machine findWithoutFail($id, $columns = ['*'])
 * @method Machine find($id, $columns = ['*'])
 * @method Machine first($columns = ['*'])
*/
class MachineRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'date',
        'ip',
        'code'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Machine::class;
    }
}

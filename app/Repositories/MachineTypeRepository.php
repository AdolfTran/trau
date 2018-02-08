<?php

namespace App\Repositories;

use App\Models\MachineType;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MachineTypeRepository
 * @package App\Repositories
 * @version February 8, 2018, 6:50 am UTC
 *
 * @method MachineType findWithoutFail($id, $columns = ['*'])
 * @method MachineType find($id, $columns = ['*'])
 * @method MachineType first($columns = ['*'])
*/
class MachineTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'price'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MachineType::class;
    }
}

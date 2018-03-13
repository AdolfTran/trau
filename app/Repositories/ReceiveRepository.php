<?php

namespace App\Repositories;

use App\Models\Receive;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ReceiveRepository
 * @package App\Repositories
 * @version March 13, 2018, 2:36 pm UTC
 *
 * @method Receive findWithoutFail($id, $columns = ['*'])
 * @method Receive find($id, $columns = ['*'])
 * @method Receive first($columns = ['*'])
*/
class ReceiveRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'amount_money',
        'months',
        'date',
        'sender',
        'receiver',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Receive::class;
    }
}

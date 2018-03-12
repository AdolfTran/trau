<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cost extends Model
{
    use SoftDeletes;

    public $table = 'cost';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'amount_money',
        'description',
        'date',
        'people'
    ];
}

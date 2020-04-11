<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SpintaxInput extends Model
{
    protected $table = 'spintax_inputs';

    protected $fillable = [
        'target'
    ];
}

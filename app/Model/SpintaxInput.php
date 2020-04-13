<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\SpintaxOutput;

class SpintaxInput extends Model
{
    protected $table = 'spintax_inputs';

    protected $fillable = [
        'target'
    ];

    public function spintax()
    {
    	return $this->belongsToMany(SpintaxOutput::class);
    }
}

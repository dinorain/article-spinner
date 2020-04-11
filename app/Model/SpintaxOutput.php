<?php

namespace App\Model;

use App\Model\SpintaxInput;
use Illuminate\Database\Eloquent\Model;

class SpintaxOutput extends Model
{
    protected $table = 'spintax_outputs';

    protected $fillable = [
        'spintax'
    ];

    public function target()
    {
        return $this->belongsTo(SpintaxInput::class, 'target_id', 'id');
    }
}

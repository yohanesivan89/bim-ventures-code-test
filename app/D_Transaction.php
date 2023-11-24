<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class D_Transaction extends Model
{
    protected $table = 'd__transactions';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $casts = [
        'amount' => 'decimal:2'
    ];
}

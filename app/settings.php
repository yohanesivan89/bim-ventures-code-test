<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    protected $table = 'settings';

    public $primaryKey = 'id';

    public $timestamps = true;
}

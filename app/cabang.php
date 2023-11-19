<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cabang extends Model
{
    protected $table = 'cabangs';

    public $primaryKey = 'id';

    public $timestamps = true;
}

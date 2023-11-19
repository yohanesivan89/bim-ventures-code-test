<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ddevice extends Model
{
    protected $table = 'ddevices';

    public $primaryKey = 'id';

    public $timestamps = true;

    public function cabang()
    {
        return $this->hasOne('App\cabang','id','idcabang');
    }

    public function mdevice()
    {
        return $this->belongsTo('App\device','name','name');
    }
}

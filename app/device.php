<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class device extends Model
{
    protected $table = 'devices';

    public $primaryKey = 'id';

    public $timestamps = true;

    public function cabang()
    {
        return $this->hasOne('App\cabang','id','idcabang');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adminModel extends Model
{
    public $table='admin';
    public $primaryKey='id';
    public $incrementing=true;
    public $keyType='int';
    public  $timestamps=false;
}

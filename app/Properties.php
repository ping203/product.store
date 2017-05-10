<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    protected $table = 'properties';

    protected $fillable = ['id', 'name'];

    public $timestamps = true;

    public function values()
    {
        return $this->hasMany('App\PropertiesValue', 'properties_id');
    }

}

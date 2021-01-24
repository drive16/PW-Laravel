<?php

namespace NetworkConfigurator;

use Illuminate\Database\Eloquent\Model;

class Router extends Model
{
    protected $table = "router";
    public $timestamps = false;
    public $incrementing = false; //la primary key non è un integer
    
    protected $primaryKey = 'serialNumber';
    protected $fillable = ['name', 'model', 'type', 'firmware', 'ports'];
    
    public function user() {
        return $this->belongsTo('NetworkConfigurator\User');
    }
    
    public function configuration() {
        return $this->hasOne('NetworkConfigurator\Configuration', 'deviceID');
    }
}

<?php

namespace NetworkConfigurator;

use Illuminate\Database\Eloquent\Model;

class Switches extends Model
{
    protected $table = "switches";
    public $timestamps = false;
    public $incrementing = false; //la primary key non è un integer
    
    protected $primaryKey = 'serialNumber';
    protected $fillable = ['name', 'model', 'type', 'firmware', 'ports'];
    
    public function user() {
        return $this->belongsTo('NetworkConfigurator\User');
    }
    
    public function configuration() {
        return $this->hasOne('NetworkConfigurator\SwitchConfiguration', 'deviceID');
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getSN() {
        return $this->serialNumber;
    }
}

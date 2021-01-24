<?php

namespace NetworkConfigurator;

use Illuminate\Database\Eloquent\Model;

class SwitchConfiguration extends Model
{
    protected $table = "switches_configuration";
    public $timestamps = false;
    
    protected $fillable = ['hostname', 'username', 'password', 'domainName', 'interface', 'ipAddress', 'subnetMask', 'gateway', 'deviceID'];
    
    public function switches() {
        return $this->belongsTo('NetworkConfigurator\Switches');
    }
}



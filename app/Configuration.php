<?php

namespace NetworkConfigurator;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = "configuration";
    public $timestamps = false;
    
    protected $fillable = ['hostname', 'username', 'password', 'domainName', 'interface', 'ipAddress', 'subnetMask', 'gateway', 'deviceID'];
    
    public function router() {
        return $this->belongsTo('NetworkConfigurator\Router');
    }
}

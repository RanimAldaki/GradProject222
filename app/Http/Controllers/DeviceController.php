<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Traits\Helper;
use App\Traits\ReturnResponse;


class DeviceController extends Controller
{
    use ReturnResponse;
    use Helper;

    public function index(){
        $devices = Device::all();
        return $this->returnData('devices', $devices);
    }
}

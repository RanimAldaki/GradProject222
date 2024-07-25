<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Traits\Helper;
use App\Traits\ReturnResponse;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    use ReturnResponse;
    use Helper;

    public function index()
    {
        $records = Record::query()
            ->select('records.*')
            ->join('orders as o', 'records.order_id', '=', 'o.id')
            ->leftJoin('appointments as a', 'o.id', '=', 'a.order_id')
<<<<<<< HEAD
            ->with(['user:id,name,email,phone,uId', 'order:location,id', 'appointment','diagnose'])
=======
            ->with(['user:id,name,email,phone,uId', 'order', 'appointment'])
            ->where(function ($query) {
                $query->where('o.state', 'waiting')
                    ->orWhere('o.state', 'Detect')
                    ->orWhere('o.state', 'Execute')
                    ->orWhere('o.state', 'Done');
            })
>>>>>>> 70f0be320d1ad5a027774f1914d8b0d973d3b823
            ->get();

        return $this->returnData('records', $records);
    }

    public function showMyRecord()
    {
        $userId = Auth::id();
        $records = Record::query()
            ->select('records.*')
            ->join('orders as o', 'records.order_id', '=', 'o.id')
            ->leftJoin('appointments as a', 'o.id', '=', 'a.order_id')
            ->where('records.user_id', $userId)
<<<<<<< HEAD
            ->with(['user:id,name,email,phone,uId', 'order:location,id', 'appointment','diagnose'])
=======
            ->with(['user:id,name,email,phone,uId', 'order', 'appointment'])
            ->where(function ($query) {
                $query->where('o.state', 'waiting')
                    ->orWhere('o.state', 'Detect')
                    ->orWhere('o.state', 'Execute')
                    ->orWhere('o.state', 'Done');
            })
>>>>>>> 70f0be320d1ad5a027774f1914d8b0d973d3b823
            ->get();

        return $this->returnData('records', $records);


    }


}

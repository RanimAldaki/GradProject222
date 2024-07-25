<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
<<<<<<< HEAD
use App\Models\Diagnosis;
use App\Models\Invoices;
use App\Models\Order;
use App\Models\Product;
=======
use App\Models\Invoices;
use App\Models\Order;
>>>>>>> 70f0be320d1ad5a027774f1914d8b0d973d3b823
use App\Models\Record;
use App\Models\Status;
use App\Models\Type;
use App\Traits\Helper;
use App\Traits\ReturnResponse;
<<<<<<< HEAD
=======
use Egulias\EmailValidator\Warning\ObsoleteDTEXT;
>>>>>>> 70f0be320d1ad5a027774f1914d8b0d973d3b823
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    use ReturnResponse;
    use Helper;

    public function index()
    {
        $appointment = Appointment::query()->select(['*'])
            ->with(['user' => function ($query) {
                    $query->select(['id', 'name', 'email', 'phone', 'uId']);
<<<<<<< HEAD
                }, 'order.products']
=======
                },'order.products']
>>>>>>> 70f0be320d1ad5a027774f1914d8b0d973d3b823
            )
            ->get();

        if ($appointment) {
            return $this->returnData('appointment', $appointment);
        } else {

            return $this->returnError(404, 'appointment not found');
        }
    }

    public function store(Request $request)
    {
        $orderId = $request['orderId'];
        $order = Order::find($orderId);
        if (!$order) {
            return $this->returnError(404, 'order not found');
        }
        if ($order->state == 'waiting') {
            $appointment = new Appointment();
            $appointment->create([
                'start_time' => $request['start_time'],
                'team_id' => $request['team_id'],
                'order_id' => $orderId,
                'user_id' => $order->user_id,
<<<<<<< HEAD
                'type_id' => $order->type_id,
=======
                'type_id' => 1,
>>>>>>> 70f0be320d1ad5a027774f1914d8b0d973d3b823
                'status_id' => 2
            ]);
            $order->state = 'Detect';
            $order->save();
            return $this->returnSuccessMessage('appointment accepted successfully');
        } else {
            return $this->returnError(400, 'order cannot be accepted');
        }
    }

    public function update(Request $request, $appId)
    {
        $input = $request->all();
        $appointment = Appointment::with('order.products')->find($appId);

        if (!$appointment) {
            return $this->returnError(404, 'Appointment not found');
        }

        $validator = Validator::make($input, [
            'products' => 'nullable|array',
            'products.*.id' => 'required_with:products|exists:products,id',
            'products.*.amount' => 'required_with:products|numeric|between:0,99.99',
<<<<<<< HEAD
            'end_time' => 'required|date'
=======
>>>>>>> 70f0be320d1ad5a027774f1914d8b0d973d3b823
        ]);

        if ($validator->fails()) {
            return $this->returnError(422, $validator->errors());
        }

        $order = $appointment->order;

        if (!$order) {
            return $this->returnError(404, 'Order not found');
        }

        if (isset($input['products'])) {
<<<<<<< HEAD
            $productsWithAmount = [];

            foreach ($input['products'] as $product) {
                $productModel = Product::find($product['id']);

                if (!$productModel) {
                    return $this->returnError(404, 'Product not found');
                }

                if ($productModel->quantity < $product['amount']) {
                    return $this->returnError(422, 'Insufficient quantity available for product ID: ' . $product['id']);
                }

                $productModel->quantity -= $product['amount'];
                $productModel->save();

                $productsWithAmount[$product['id']] = ['amount' => $product['amount']];
            }
            $order->products()->attach($productsWithAmount);
        }
        $order->state = 'Execute';

        $order->save();
        $appointment->end_time = $request['end_time'];
        $appointment->status_id = 3;
        $appointment->save();
        return $this->returnSuccessMessage('Products quantities updated and attached to order successfully');
=======
            $products = [];
            foreach ($input['products'] as $product) {
                $products[$product['id']] = ['amount' => $product['amount']];
            }
            $order->products()->sync($products);
        }

        $order->state = 'Execute';
        $order->save();

        $productsWithDetails = $order->products()->get();

        return $this->returnData('Order updated successfully', ['products' => $productsWithDetails]);
>>>>>>> 70f0be320d1ad5a027774f1914d8b0d973d3b823
    }


    public function teamApp($teamID)
    {
        $apps = Appointment::query()->where('team_id', '=', $teamID)
<<<<<<< HEAD
            ->with(['user', 'order.products'])->get();
=======
            ->with(['user','order.products'])->get();
>>>>>>> 70f0be320d1ad5a027774f1914d8b0d973d3b823
        return $this->returnData('Appointments:', $apps);
    }

    public function done(Request $request, $appId)
    {
        $appointment = Appointment::find($appId);
<<<<<<< HEAD
        $input = $request->all();
        $validator = Validator::make($input, [
            'desc' => 'required|string',
            'otherPrice' => 'required|numeric|between:0,99.99'
        ]);
        if ($validator->fails()) {
            return $this->returnError(422, $validator->errors());
        }
        if ($appointment->type_id == 1) {
            $order = Order::find($appointment->order_id);
            $record = Record::where('order_id', $appointment->order_id)->first();

            if (!$record) {
                $record = new Record();
                $record->order_id = $order->id;
                $record->user_id = $order->user_id;
                $record->save();
            }


            $diagnosis = new Diagnosis();
            $diagnosis->record_id = $record->id;
            $diagnosis->type_id = 1;
            $diagnosis->desc = $input['desc'];
            $diagnosis->date = now();
            $diagnosis->save();

            $appointment->status_id = 4;
            $appointment->save();

            $order->state = 'Done';
            $order->save();

=======

        if ($appointment->type_id == 1) {
            $input = $request->all();
            $validator = Validator::make($input, [
                'desc' => 'required|string',
                'otherPrice' => 'required|numeric|between:0,99.99'
            ]);

            if ($validator->fails()) {
                return $this->returnError(422, $validator->errors());
            }

            $order = Order::find($appointment->order_id);
            $record = Record::find($appointment->order_id);
            $record->desc = $input['desc'];
            $record->save();
            $appointment->end_time = now();
            $appointment->status_id=4;
            $appointment->save();
            $order->state = 'Done';
            $order->save();
>>>>>>> 70f0be320d1ad5a027774f1914d8b0d973d3b823
            $invoice = new Invoices();
            $invoice->create([
                'order_id' => $order->id,
                'date' => now(),
<<<<<<< HEAD
                'otherPrice' => $request['otherPrice'],
                'totalPrice' => $this->calculateTotalPrice($order->id) + $request['otherPrice'],
            ]);
        } elseif ($appointment->type_id == 2) {
            $appointment->end_time = now();
            $appointment->status_id = 4;
            $appointment->save();

            $order = Order::find($appointment->order_id);
            $order->state = 'Done';
            $order->save();

            $record = Record::where('order_id', $order->id)->first();

            if (!$record) {
                $record = new Record();
                $record->order_id = $order->id;
                $record->user_id = $order->user_id;
                $record->save();
            }


            $diagnosis = new Diagnosis();
            $diagnosis->record_id = $record->id;
            $diagnosis->type_id = 2;
            $diagnosis->desc = $input['desc'];
            $diagnosis->date = now();
            $diagnosis->save();

=======
                'otherPrice'=>$request['otherPrice'],
                'totalPrice' => $this->calculateTotalPrice($order->id)+$request['otherPrice'],
            ]);
        } elseif ($appointment->type_id == 2) {
            $appointment->end_time = now();
            $appointment->status_id=4;
            $appointment->save();
            $order = Order::find($appointment->order_id);
            $order->state = 'Done';
            $order->save();
>>>>>>> 70f0be320d1ad5a027774f1914d8b0d973d3b823
            $invoice = new Invoices();
            $invoice->create([
                'order_id' => $order->id,
                'date' => now(),
<<<<<<< HEAD
                'otherPrice' => $request['otherPrice'],
                'totalPrice' => $this->calculateTotalPrice($order->id) + $request['otherPrice'],
=======
                'otherPrice'=>$request['otherPrice'],
                'totalPrice' => $this->calculateTotalPrice($order->id)+$request['otherPrice'],
>>>>>>> 70f0be320d1ad5a027774f1914d8b0d973d3b823
            ]);
        }

        return $this->returnSuccessMessage('Order updated successfully');
    }

    public function getType()
    {
        $type = Type::all();
        return $this->returnData('types : ', $type);
    }

    public function getStatus()
    {
        $status = Status::all();
        return $this->returnData('statuses : ', $status);
    }
}

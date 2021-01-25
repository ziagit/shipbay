<?php

namespace App\Http\Controllers\Order;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
use App\Http\Requests\CheckoutRequest;
use App\Order;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkout');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->roles[0]->name === 'shipper') {
            if ($this->checkCustomer() === null) {
                try {
                    $customer = Stripe::customers()->create([
                        'source' => $request->stripeToken,
                        'email' => $request->email,
                        'name' => $request->name,
                        'description' => "Paied for shipment",
                    ]);
                    $this->updateUser($customer['id']);
                    return [
                        'message' => 'Thank you! your card added successfully.', 
                        'id' => null,
                        'status' => 'unpaid',
                        'email' => $request->email
                    ];
                } catch (Exception $e) {
                    return $e;
                }
            } else {
                $customerId = $this->checkCustomer();
                $customer = Stripe::customers()->update($customerId, [
                    'source' => $request->stripeToken,
                    'email' => $request->email,
                    'name' => $request->name,
                    'description' => "Paied for shipment",
                ]);
                return [
                    'message' => 'Thank you! your card updated successfully.', 
                    'id' => null,
                    'status' => 'unpaid',
                    'email'=> $request->email
                ];
            }
        } else {
            return $this->charge($request);
        }
    }

    public function chargeCustomer(Request $request)
    {
        if (!$request->id) {
            $customer = Auth::user();
            try {
                $charge = Stripe::charges()->create([
                    'amount' => $request->price,
                    'currency' => 'USD',
                    'description' => 'Shipment costs',
                    'customer' => $customer->customer_id
                ]);
                $orderId = $this->createEmptyOrder($charge['id']);
                return [
                    'message' => 'Thank you! your payment was successful.', 
                    'id' => $orderId,
                    'status' => 'paid',
                    'email' => $request->email
                ];
            } catch (CardErrorException $e) {
                return $e;
            }
        } else {
            $order = Order::where('uniqid',$request->id)->first();
            if (Stripe::charges()->find($order->charge_id)) {
                return [
                    'message' => 'You already paid for this order!', 
                    'id' => $request->id,
                    'status' => 'paid',
                    'email' => $request->email
                ];
            }
        }
    }
    public function charge($request)
    {
        if (!$request->orderId) {
            try {
                $charge = Stripe::charges()->create([
                    'amount' => $request->price,
                    'currency' => 'USD',
                    'source' => $request->stripeToken,
                    'description' => 'Shipment costs',
                    'receipt_email' => $request->email,
                ]);
                $orderId = $this->createEmptyOrder($charge['id']);
                return [
                    'message' => 'Thank you! your payment was successful.', 
                    'id' => $orderId,
                    'status' => 'paid',
                    'email' => $request->email
                ];
            } catch (CardErrorException $e) {
                return $e;
            }
        } else {
            $order = Order::where('uniqid',$request->orderId)->first();
            if (Stripe::charges()->find($order->charge_id)) {
                return [
                    'message' => 'You already paid for this order!', 
                    'id' => $request->orderId,
                    'status' => 'paid',
                    'email' => $request->email
                ];
            }
        }
    }
    public function checkCustomer()
    {
        $customerId = Auth::user()->customer_id;
        if ($customerId) {
            $customer = Stripe::customers()->find($customerId);
            return $customer['id'];
        } else {
            return null;
        }
    }

    public function updateUser($customerId)
    {
        $user = Auth::user()->id;
        $user = User::find($user);
        $user->customer_id = $customerId;
        $user->update();
        return true;
    }
    public function createEmptyOrder($chargeId)
    {
        $order = new Order();
        $order->charge_id = $chargeId;
        $order->uniqid ='SHBO'.date('Ymd').rand();
        $order->save();
        return $order->uniqid;
    }
    public function checkPayment($id)
    {
        $order = Order::where('uniqid',$id)->first();
        if ($order) {
            if (Stripe::charges()->find($order->charge_id)) {
                return ['message'=>'Thanks! you paid.', 'status'=>true];
            }
            return ['message'=>'Charge id not muching','status'=>false];
        }
        return ['message'=>'Order not found','status'=>false];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

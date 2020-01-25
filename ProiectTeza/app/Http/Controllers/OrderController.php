<?php

namespace App\Http\Controllers;

use App\Order;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Ship the given order.
     *
     * @param  Request  $request
     * @param  int  $orderId
     * @return response
     */
    
	  public function sendEmail()
    {
      $user = auth()->user();
      Mail::to($user)->send(new OrderShipped($user));
 
      if (Mail::failures()) {
           return response()->Fail('Sorry! Please try again latter');
      }else{
           return response()->success('Great! Successfully send in your mail');
         }
    }

    // public function ship(Request $request, $orderId)
    // {
    //     $order = Order::findOrFail($orderId);

    //     Mail::to($request->user())->send(new OrderShipped($order));
    // }

}
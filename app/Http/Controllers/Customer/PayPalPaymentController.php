<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Paypal\CreatePayment;
use App\Paypal\ExecutePayment;
use Illuminate\Http\Request;

//use Srmklive\PayPal\Services\ExpressCheckout as ExpressCheckout;
use PayPal;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use phpDocumentor\Reflection\Types\Parent_;
use Countries;


class PayPalPaymentController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'carts.*' => 'required|exists:\App\Models\Cart,id',
        ]);
        $create_paypal = new CreatePayment();
        $carts = \App\Models\Cart::whereIn('id', $request->carts)->get();

        return $create_paypal->create($carts);
    }


    public function execute()
    {
        $execute = new ExecutePayment();
        $res = json_decode($execute->execute());

        $payer_info = $res->payer->payer_info;
        $shipping_address = $res->payer->payer_info->shipping_address;

        $bill = new \App\Models\Bill();
        $bill->user_id = auth()->user()->id;
        $bill->name = $payer_info->first_name . " " . $payer_info->last_name;
        $bill->country = Countries::getOne($payer_info->country_code, 'en');
        $bill->save();

        $carts = collect([]);
        $orders = collect([]);

        foreach ($res->transactions as $trans) {

            $shipping_detail = $trans->item_list->shipping_address;

            $shipping = new \App\Models\Shipping();
            $shipping->user_id = auth()->user()->id;
            $shipping->name = $shipping_detail->recipient_name;
            $shipping->street_address1 = $shipping_detail->line1;
            if (isset($shipping_detail->line2)) {
                $shipping->street_address2 = $shipping_detail->line2;
            }
            $shipping->city = $shipping_detail->city;
            $shipping->state = $shipping_detail->state;
            $shipping->country = Countries::getOne($payer_info->country_code, 'en');
            $shipping->shipping_status = "Pending";
            $shipping->postal_code = $shipping_detail->postal_code;
            $shipping->save();

            foreach ($trans->item_list->items as $item) {
                $cart_id = $item->sku;
                try {
                    $cart = \App\Models\Cart::where('id', $cart_id)->firstOrFail();
                    $carts->add($cart);

                    $order = new \App\Models\Order;
                    $order->user_id = auth()->user()->id;
                    $order->product_id = $cart->Product->id;
                    $order->price = $cart->Product->price;
                    $order->discount = $cart->Product->discount;
                    $order->quantity = $item->quantity;
                    $order->order_status = "Pending";
                    $order->bill_id = $bill->id;
                    $order->shipping_id = $shipping->id;
                    $order->save();

                    $orders->add($order);

                    $cart->delete();
                } catch (\Exception $e) {
                    foreach ($carts as $c) {
                        $c->save();
                    }
                    foreach ($orders as $o) {
                        $o->delete();
                    }
                    $bill->delete();
                    $shipping->delete();
                    break;
                }

            }
        }
        foreach($orders as $order){
            $order->Product->quantity_available = $order->Product->quantity_available - $order->quantity;
            $order->Product->quantity_sold = $order->Product->quantity_sold + $order->quantity;
            $order->Product->save();
        }

        return redirect()->route('customer.bills.show',$bill->id);
    }

    public function cancel()
    {
        dd("Payment cancelled due to some error");
    }
}

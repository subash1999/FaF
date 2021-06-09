<?php
/**
 * Created by PhpStorm.
 * User: sarthak
 * Date: 02/11/18
 * Time: 8:33 PM
 */

namespace App\Paypal;


use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class CreatePayment extends Paypal
{
    public function create($carts)
    {
        $items = array();
        $this->amount = 0;
        foreach ($carts as $cart) {
            $item = new Item();
            $item->setName($cart->Product->name)
                ->setCurrency($this->currency)
                ->setQuantity($cart->quantity)
                ->setSku($cart->id) // Similar to `item_number` in Classic API
                ->setPrice($cart->Product->final_price);
            $this->amount += $cart->quantity*$cart->Product->final_price;
            array_push($items,$item);
        }

        $itemList = new ItemList();
        $itemList->setItems($items);

        $payment = $this->Payment($itemList);

        $payment->create($this->apiContext);
        return redirect($payment->getApprovalLink());
    }

    /**
     * @return Payer
     */
    protected function Payer()
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        return $payer;
    }

    /**
     * @param $itemList
     * @return Transaction
     */
    protected function Transaction($itemList)
    {
        $transaction = new Transaction();
        $transaction->setAmount($this->Amount())
            ->setItemList($itemList)
            ->setDescription('Payment description')
            ->setInvoiceNumber(uniqid());
        return $transaction;
    }

    /**
     * @return RedirectUrls
     */
    protected function RedirectUrls()
    {
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($this->redirect_url)
            ->setCancelUrl($this->cancel_url);
        return $redirectUrls;
    }

    /**
     * @param $itemList
     * @return Payment
     */
    protected function Payment($itemList)
    {
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($this->payer())
            ->setRedirectUrls($this->RedirectUrls())
            ->setTransactions([$this->transaction($itemList)]);
        return $payment;
    }
}

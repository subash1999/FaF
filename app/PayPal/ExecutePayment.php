<?php
/**
 * Created by PhpStorm.
 * User: sarthak
 * Date: 03/11/18
 * Time: 12:56 PM
 */

namespace App\Paypal;


use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

// references https://www.youtube.com/watch?v=zGzBVBcEj84&list=PLe30vg_FG4OSdVn4zFpXNpBILtijJ2-x7&index=6&ab_channel=Bitfumes
class ExecutePayment extends Paypal
{
    public function execute()
    {
        $payment = $this->GetThePayment();
        $execution = $this->CreateExecution();
//        $execution->addTransaction($this->transaction());
//        dd($payment);
        $result = $payment->execute($execution, $this->apiContext);

        return $result;
    }

    /**
     * @return Payment
     */
    protected function GetThePayment()
    {
        $paymentId = request('paymentId');
        $payment = Payment::get($paymentId, $this->apiContext);
        return $payment;
    }

    /**
     * @return PaymentExecution
     */
    protected function CreateExecution()
    {
        $execution = new PaymentExecution();
        $execution->setPayerId(request('PayerID'));
        return $execution;
    }

    /**
     * @return Transaction
     */
    protected function transaction()
    {
        $transaction = new Transaction();
//        $transaction->setAmount($this->amount());
        return $transaction;
    }
}

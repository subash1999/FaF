<?php
namespace App\Paypal;


use PayPal\Api\Amount;
use PayPal\Api\Details;

// references https://www.youtube.com/watch?v=zGzBVBcEj84&list=PLe30vg_FG4OSdVn4zFpXNpBILtijJ2-x7&index=6&ab_channel=Bitfumes
class Paypal
{
    protected $apiContext;
    protected $currency;
    protected $amount = 0;
    protected $redirect_url, $cancel_url;


    public function __construct()
    {
        $this->apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                config('services.paypal.id'), // client id
                config('services.paypal.secret')
            )
        );
        $this->currency = config('services.paypal.currency');
        $this->redirect_url = route('customer.payment.execute');
        $this->cancel_url = route('customer.payment.cancel');
    }

    /**
     * @return Details
     */
    protected function details()
    {
        $details = new Details();
//        $details->setShipping(1.2)
//            ->setTax(1.3)
//            ->setSubtotal(17.50);
        return $details;
    }

    /**
     * @return Amount
     */
    protected function amount()
    {
        $amount = new Amount();
        $amount->setCurrency($this->currency);
        $amount->setTotal($this->amount);
        $amount->setDetails($this->details());
        return $amount;
    }

}

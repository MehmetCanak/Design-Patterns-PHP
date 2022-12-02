<?php 

use App\Builder\DirectDebitPaymentMethodBuilder;
use App\Builder\PaymentMethodDirector;

class BuilderTest
{ 
    public   function   testCanBuildDirectDebitPaymentMethod () 
    { 
        $paymentMethodBuilder   =   new   DirectDebitPaymentMethodBuilder ();
        $paymentDirector  =   new   PaymentMethodDirector($paymentMethodBuilder);
        $paymentMethod  =  $paymentDirector->buildPaymentMethod($paymentMethodBuilder);
        var_dump($paymentMethod);
        die;
    } 
}

$test = new BuilderTest();
$test->testCanBuildDirectDebitPaymentMethod();





?>
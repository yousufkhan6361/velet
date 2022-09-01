<?php
Class TwoCO {
    public function dummy($value=''){}
}

abstract class Twocheckout
{
    public static $sid;
    public static $privateKey;
    public static $username;
    public static $password;
    public static $sandbox;
    public static $verifySSL = true;
    public static $baseUrl = 'https://www.2checkout.com';
    public static $error;
    public static $format = 'array';
    const VERSION = '0.3.0';

    public static function sellerId($value = null) {
        self::$sid = $value;
    }

    public static function privateKey($value = null) {
        self::$privateKey = $value;
    }

    public static function username($value = null) {
        self::$username = $value;
    }

    public static function password($value = null) {
        self::$password = $value;
    }

    public static function sandbox($value = null) {
        if ($value == 1 || $value == true) {
            self::$sandbox = true;
            self::$baseUrl = 'https://sandbox.2checkout.com';
        } else {
            self::$sandbox = false;
            self::$baseUrl = 'https://www.2checkout.com';
        }
    }

    public static function verifySSL($value = null) {
        if ($value == 0 || $value == false) {
            self::$verifySSL = false;
        } else {
            self::$verifySSL = true;
        }
    }

    public static function format($value = null) {
        self::$format = $value;
    }
}

require(APPPATH . 'libraries/TwoCheckout/Api/TwocheckoutAccount.php');
require(APPPATH . 'libraries/TwoCheckout/Api/TwocheckoutPayment.php');
require(APPPATH . 'libraries/TwoCheckout/Api/TwocheckoutApi.php');
require(APPPATH . 'libraries/TwoCheckout/Api/TwocheckoutSale.php');
require(APPPATH . 'libraries/TwoCheckout/Api/TwocheckoutProduct.php');
require(APPPATH . 'libraries/TwoCheckout/Api/TwocheckoutCoupon.php');
require(APPPATH . 'libraries/TwoCheckout/Api/TwocheckoutOption.php');
require(APPPATH . 'libraries/TwoCheckout/Api/TwocheckoutUtil.php');
require(APPPATH . 'libraries/TwoCheckout/Api/TwocheckoutError.php');
require(APPPATH . 'libraries/TwoCheckout/TwocheckoutReturn.php');
require(APPPATH . 'libraries/TwoCheckout/TwocheckoutNotification.php');
require(APPPATH . 'libraries/TwoCheckout/TwocheckoutCharge.php');
require(APPPATH . 'libraries/TwoCheckout/TwocheckoutMessage.php');

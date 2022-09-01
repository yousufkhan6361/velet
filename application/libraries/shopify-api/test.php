<?php
/**
 * Created by PhpStorm.
 * User: developers.demo
 * Date: 2/27/2019
 * Time: 12:26 PM
 */

require __DIR__ . '/vendor/autoload.php';

$token = "18623641fd51daddd794b4cdb847357a";    // Access token
$shop = "sandbox-store-mike.myshopify.com";

// Assumes setup of client with access token.
$mgr = ShopifyApi\Manager::init($shop, $token);
/*$mgr->getProduct($product_id = 123);              // returns ShopifyApi/Models/Product

// Alternatively, we may call methods on the API object.
$mgr->api('products')->show($product_id = 123);   // returns array*/

$products = $mgr->getAllProducts();
//echo json_encode($products[0],true);
//$encode = json_decode($products, true);
//var_dump($products[0]->getData());
//echo json_decode($encode,true);
/*echo "<pre>";
//print_r($products);
print_r($products[0]);*/


//var_dump($products[0]->getData());    //
if(count($products)>0){
    foreach($products as $key=>$value):
        var_dump($value->getData());
    endforeach;
}
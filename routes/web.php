<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
use Illuminate\Http\Request;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//CONVERSOR
$router->post('/currency/convert', function (Request $request) use ($router) {
    libxml_use_internal_errors(true);
    $amount = $request->input('amount');
    $from = $request->input('from');
    $to = $request->input('to');

    $data = file_get_contents("https://finance.google.com/finance/converter?a=$amount&from=$from&to=$to");
    preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
    $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
    $return['converted'] = number_format(round($converted, 3),2);
	return response()->json($return);
});

//GET CURRENCIES
$router->get('/currency/currencies', function () use ($router) {
    libxml_use_internal_errors(true);
    $dom = new DOMDocument();
    $dom->loadHTML(file_get_contents("https://finance.google.com/finance/converter"));
    
    $div = $dom->getElementsByTagName('select');
    $opts = $div[0]->getElementsByTagName('option');
    foreach($opts as $op){
        $return[] = array(
            'value'=>$op->attributes[0]->value,
            'name'=>$op->nodeValue
        );
    }

    return response()->json($return);
});
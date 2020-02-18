<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use App\Orders;
use App\OrderItems;
use Illuminate\Support\Facades\Log;

use App\Bill_header;
use App\Bill_item;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    private $_api_context;

	public function __construct()
	{
		// setup PayPal api context
		$paypal_conf = \Config::get('paypal');
		$this->_api_context = new ApiContext(new OauthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
	}
    public function postPayment(Request $request){
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $items = array();
		$subtotal = 0;
        $cart = $request->session()->get('cart');
        $currency = 'EUR';
        foreach($cart->items as $movie){
			$item = new Item();
			$item->setName($movie['item']['name'])
			->setCurrency($currency)
			->setDescription('bought movie')
			->setQuantity(1)
			->setPrice($movie['item']['price']);
			$items[] = $item;
			$subtotal += $movie['item']['price'];
		}


        $item_list = new ItemList();
        $item_list->setItems($items);

        $details = new Details();
        $details->setSubtotal($subtotal);
        $total = $subtotal;
        $amount = new Amount();
        $amount->setCurrency($currency)
            ->setTotal($total)
            ->setDetails($details);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Comanda de prova en la botiga-Laravel');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(\URL::route('payment.status'))
            ->setCancelUrl(\URL::route('payment.status'));
        $payment = new payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
            try {
                $payment->create($this->_api_context);
            } catch (\PayPal\Exception\PPConnectionException $ex) {
                if (\Config::get('app.debug')) {
                    echo "Exception: " . $ex->getMessage() . PHP_EOL;
                    $err_data = json_decode($ex->getData(), true);
                    exit;
                } else {
                    die('Error! Quelcom ha eixit malament');
                }
            }
            foreach($payment->getLinks() as $link) {
                if($link->getRel() == 'approval_url') {
                    $redirect_url = $link->getHref();
                    break;
                }
            }
            // add payment ID to session
        $request->session()->put('paypal_payment_id', $payment->getId());
        if(isset($redirect_url)) {
            // redirect to paypal
            \Log::debug($redirect_url);
			return \Redirect::away($redirect_url);
		}

		return \Redirect::route('cart-show')
			->with('error', 'Error desconegut.');

    } //clau de final de mètode.

    public function getPaymentStatus(Request $request)
		{
			// Get the payment ID before session clear
			$payment_id = \Session::get('paypal_payment_id');
			// clear the session payment ID
            \Session::forget('paypal_payment_id');

            $payerId = $request->get('PayerID');
			$token = $request->get('token');
			//if (empty($request->get('PayerID')) || empty($request->get('token'))) {
			if (empty($payerId) || empty($token)) {
				return  redirect()->action('CatalogController@index', ['message' => "
                Error at paying with PayPal", 'messageType' => 'danger']);
            }
            $payment = Payment::get($payment_id, $this->_api_context);
            // PaymentExecution object includes information necessary
            // to execute a PayPal account payment.
            // The payer_id is added to the request query parameters
            // when the user is redirected from paypal back to your site
            $execution = new PaymentExecution();
            $execution->setPayerId($request->get('PayerID'));
            //Execute the payment
            $result = $payment->execute($execution, $this->_api_context);
            if ($result->getState() == 'approved') { // payment made
                $cart = $request->session()->get('cart');
                $header_bill = new Bill_header;
                $header_bill->total_price = $cart->totalPrice;
                $header_bill->user_id = Auth::id();
                $header_bill->save();
                $header_bill_id = Bill_header::all()->last()->id;
                \Log::debug($header_bill_id);
                foreach($cart->items as $movie){
                    $item_bill = new Bill_item;
                    $item_bill->movie_id = $movie['item']['id'];
                    $item_bill->bill_header_id = $header_bill_id;
                    $item_bill->save();
                }

                \Session::forget('cart');
                return  redirect()->action('CatalogController@index', ['message' => "
                Purchase completed", 'messageType' => 'success']);
            }
            return  redirect()->action('CatalogController@index', ['message' => "
            The purchase has been canceled", 'messageType' => 'danger']);
        } //finalització del mètode getPaymentStatus

}


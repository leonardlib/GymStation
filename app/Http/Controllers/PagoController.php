<?php

namespace App\Http\Controllers;

use App\ClaseUsuarioInstructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Netshell\Paypal\Facades\Paypal;

class PagoController extends Controller {
    private $_apiContext;

    public function __construct() {
        $this->_apiContext = PayPal::ApiContext(
            //config('services.paypal.client_id'),
            //config('services.paypal.secret')
            env('PAYPAL_CLIENT_ID'),
            env('PAYPAL_SECRET')
        );

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));

    }

    public function generarPago($idClase) {
        $idUsuario = Auth::user()->id;

        $claseUsuarioInstructor = ClaseUsuarioInstructor::where('id_usuario_instructor', $idUsuario)
                                                                ->where('id_clase', $idClase)
                                                                ->first();
        $clase = $claseUsuarioInstructor->clase;
        $total = $clase->costo;
        $descripcion = $clase->nombre . ' - $' . $total;

        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');

        $amount = PayPal:: Amount();
        $amount->setCurrency('MXN');
        $amount->setTotal($total);

        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription($descripcion);

        $redirectUrls = PayPal:: RedirectUrls();
        $redirectUrls->setReturnUrl(url('/clase/pago-completo'));
        $redirectUrls->setCancelUrl(url('/clase/pago-cancelado'));

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return redirect()->to($redirectUrl)->with('idClase', $claseUsuarioInstructor->id);
    }

    public function completo(Request $request) {
        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');
        $idClase = $request->session()->get('idClase');

        $payment = PayPal::getById($id, $this->_apiContext);

        $paymentExecution = PayPal::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        // Clear the shopping cart, write to database, send notifications, etc.
        //Pagar clase
        $claseUsuarioInstructor = ClaseUsuarioInstructor::find($idClase);
        $claseUsuarioInstructor->pagada = true;
        $claseUsuarioInstructor->save();
        $request->session()->forget('idClase');

        //Enviar email de pago de clase
        $claseUsuarioInstructor->enviarEmailPagoClase(Auth::user()->email);

        // Thank the user for the purchase
        return redirect()->to('/usuario');
    }

    public function cancelar() {
        // Curse and humiliate the user for cancelling this most sacred payment (yours)
        return redirect()->to('/usuario');
    }
}

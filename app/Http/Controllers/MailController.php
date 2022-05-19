<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use Auth;

class MailController extends Controller
{
    public function basic_email(Request $request) {
        $user = Auth::user();
        $data =  DB::table("tb_cotacoes")
        ->where('user_id', '=', $user->id)
        ->where('id', '=', $request->id)
        ->get();

$cot = $data[0];
$ct = array("data"=>  "Moeda Origem: $cot->MoedaOrigem 
                               Moeda Destino : $cot->MoedaDestino
                                vConvercao: $cot->vConvercao
                                Tipo Pgto: $cot->formaPagamento
                                Cotacao:$cot->vMoedaDestino
                                Valor Comprado: $cot->vFinalCompradoMoedaDestino
                                Taxa Pgto: $cot->vTaxaPagamentoOrigem
                                Taxa Converção: $cot->vTaxaConversaoOrigem
                                Valor gasto: $cot->vFinalUtilizadoOrigem
                                Data:$cot->created_at");

       
      
     
        Mail::send(['text'=>'mail'], $ct, function($message) {
           $message->to('curexchange@gmail.com', 'CurExchange')->subject
              ('Envio de Cotação de Moeda');
           $message->from('curexchange@gmail.com','User');
        });
        echo "Basic Email Sent. Check your inbox.";
     }
}

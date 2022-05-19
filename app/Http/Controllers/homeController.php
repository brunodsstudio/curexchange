<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tb_cotacoes;
use App\Models\tb_taxas;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;

class homeController extends Controller
{
    public function index(){
        //$taxas= tb_taxas::all();
        $taxas = DB::table("tb_taxas")->WhereIn("tipo", array("Boleto", "Cartão"))->get();
        $taxavalor= DB::table('tb_taxas')->where('tipo', 'like', 'txPgmto%')->get();

        $user = Auth::user();
        $cotacao =  DB::table("tb_cotacoes")->where('user_id', '=', $user->id)->get();
   
      
        //dd($taxas);
        return view(
            'pages.home',
            compact('taxas', 'taxavalor', 'cotacao'),
            []
        );
    }

    public function cotacoes(Request $request){
        $user = Auth::user();
        $cotacoes =  DB::table("tb_cotacoes")->where('user_id', '=', $user->id)->get();
        return response()->json($cotacoes);
    }

    public function taxaValor(Request $request){

        $taxas=  DB::table('tb_taxas')
              //  ->where('vref','>', $request->valor)
                ->where('tipo', 'like', 'txPgmto%')
                ->get();
                
                $t = null;

                
                foreach($taxas as $v){
                   
                    if(str_replace(",", "",$request->valor) >= $v->vref){
                        $t = $v->percentual;
                    } 
                }
                $response["valor"] = array('percentual'=> $t);


        return response()->json($response);
    }  

    public function updateTaxas(Request $request){        
       $up1 = tb_taxas::where('tipo', "txPgmto1")->update(['percentual' => $request->txPgmto1]);
       $up2 = tb_taxas::where('tipo', "txPgmto2")->update(['percentual' => $request->txPgmto2]);

        if($up2 && $up1){
            return response()-> json([
                'alteracão' => "salva"
            ], 200);
        } else {
            return response()-> json([
                'alteracão' => "deuruim!"
            ], 500);
        }
}

    public function cotacaoSave(Request $request){
        //dd($request->tipoPagamento);
        $user = Auth::user();
    
        $taxa = tb_taxas::where("percentual", "=",  $request->tipoPagamento)
        ->select('tipo')
        ->get();

        $cotacoes =  tb_cotacoes::firstOrCreate([
            "MoedaOrigem" => "BRL",
            "MoedaDestino"=> $request->currencies,
            "vConvercao" => $request->valorOrigem,
            'formaPagamento' => $taxa[0]->tipo,
            "vMoedaDestino" => $request->vMoedaDestino,
            "vFinalCompradoMoedaDestino" => $request->vFinalDestino,
            'vTaxaPagamentoOrigem' => $request->taxaPgmtReal,
            'vTaxaConversaoOrigem' => $request->taxaConversaoReal,
            'vFinalUtilizadoOrigem' => $request->valorRealGasto,
            'user_id' => $user->id
        ]);

       
        return response()-> json([
            'Cotação' => "salva"
        ], 200);
       
        /*array:10 [
            "valorOrigem" => "900.00"
            "currencies" => "EUR"
            "tipoPagamento" => "1,37"
            "dataCotacao" => "2022-05-19 13:08:22"
            "vMoedaDestino" => "5.192"
            "taxaPercentual" => "2,0"
            "taxaPgmtReal" => "12.330000000000002"
            "taxaConversaoReal" => "18"
            "valorRealGasto" => "869.67"
            "vFinalDestino" => "167.50"
          ]*/
         // return redirect()->route('home');
       
    }


} 

{{-- Extends layout --}}
@extends('layouts.home')

{{-- Content --}}
@section('content')


    <div class="row">
    <div class="col-md-2">
    </div>
        <div class="col-md-8">
        
            <form name="cotacao" id="frmCotacao" method="POST" action="">
                <fieldset>
                    <legend>Currency Exchange</legend>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="staticEmail" class="">Valor Moeda R$</label>
                                <input type="text"  class="form-control" id="valorOrigem" value="" name="valorOrigem" placeholder="900.00">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleSelect1">Moeda Destino</label>
                                <select class="form-control form-select" id="currencies" name="currencies" >
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                                    <label for="exampleSelect1">Tipo de pagamento</label>
                                    <select class="form-control form-select" id="tipoPagamento"  onchange="calculaCambio()" name="tipoPagamento">
                                        <option value="0">Selecione a forma de pagamento</option>
                                        @foreach($taxas as $k)
                                            <option value= "{{$k->percentual}}">{{$k->tipo}}</option>
                                        @endforeach
                                    </select>
                            </div>
                    </div>
                    <hr>

                    <div class="form-group">
                        <div class="row">

                            

                            <div class="col-md-6">
                                <label for="exampleSelect1">Tipo da Transação</label>
                                <input type="text" class="form-control" id="nomeCambio" name="" value="" readonly placeholder="Tipo da Transação">
                            </div>
                            
                            <div class="col-md-6">
                                <label for="exampleSelect1">Data da Cotação</label>
                                <input type="text" class="form-control" id="dataCotacao" name="dataCotacao" value="" readonly  placeholder="Data Cotação">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleSelect1">Cotação da Moeda em R$</label>
                                <input type="text" class="form-control" id="vMoedaDestino" name="vMoedaDestino" value="" readonly placeholder="Valor da Moeda em R$">
                            </div>

                            <div class="col-md-6">
                                <label for="exampleSelect1">taxa percentual</label>
                                <input type="text" class="form-control" id="taxaPercentual" name="taxaPercentual" value="" readonly  placeholder="taxa percentual">
                            </div>
                            
                            <div class="col-md-6">
                                <label for="exampleSelect1">Taxa de pagamento: R$ </label>
                                <input type="text" class="form-control" id="taxaPgmtReal" name="taxaPgmtReal" value="" readonly  placeholder="taxa percentual">
                            </div>
                            
                            <div class="col-md-6">
                                <label for="exampleSelect1">Taxa de conversão R$ </label>
                                <input type="text" class="form-control" id="taxaConversaoReal" name="taxaConversaoReal" value="" readonly  placeholder="taxa percentual">
                            </div>
                            
                            <div class="col-md-6">
                                <label for="exampleSelect1">Valor utilizado para conversão descontando as taxas R$</label>
                                <input type="text" class="form-control" id="valorRealGasto" name="valorRealGasto" value="" readonly  placeholder="taxa percentual">
                            </div>

                            <div class="col-md-12">
                                <label for="exampleSelect1">Total em Moeda Destino [descontadas as taxas]</label>
                                <input type="text" class="form-control" id="vFinalDestino" name="vFinalDestino" value="" readonly  placeholder="Total final em Moeda destino">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-primary" id="salvar">Salvar</button>
                        <div id="response"></div>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-success">Email</button>
                    </div>
                    </div>


                </fieldset>
            </form>
        </div>
       
        <div class="row" style="margin-top:10px;">
        <hr>
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <fieldset>
        
                    <legend>Últimas Cotações</legend>
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Moeda Origem</th>
                                <th>Moeda Destino</th>
                                <th>vConvercao</th>
                                <th>Tipo Pgto</th>
                                <th>Cotacao</th>

                                <th>Valor Comprado</th>
                                <th>Taxa Pgto</th>
                                <th>Taxa Converção</th>
                                <th>Valor gasto</th>
                                <th>Data</th>
                                <th>Enviar Email</th>
                     
                        
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cotacao as $cot)
                            <tr>
                                <td>{{$cot->MoedaOrigem}}</td>
                                <td>{{$cot->MoedaDestino}}</td>
                                <td>{{$cot->vConvercao}}</td>
                                <td>{{$cot->formaPagamento}}</td>
                                <td>{{$cot->vMoedaDestino}}</td>
                                <td>{{$cot->vFinalCompradoMoedaDestino}}</td>
                                <td>{{$cot->vTaxaPagamentoOrigem}}</td>
                                <td>{{$cot->vTaxaConversaoOrigem}}</td>
                                <td>{{$cot->vFinalUtilizadoOrigem}}</td>
                                <td>{{$cot->created_at}}</td>
                                <td><button onclick="enviaEmail({{$cot->id}})" class="btn btn-primary">Enviar</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Moeda Origem</th>
                                <th>Moeda Destino</th>
                                <th>vConvercao</th>
                                <th>Tipo Pgto</th>
                                <th>Cotacao</th>

                                <th>Valor Comprado</th>
                                <th>Taxa Pgto</th>
                                <th>Taxa Converção/th>
                                <th>Valor gasto</th>
                                <th>Data</th>
                                <th>Enviar Email</th>
                             
                             
                            </tr>
                        </tfoot>
                    </table>
                </fieldset>
                </div> 
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        
                                        <div class="col-md-12">
                                            <label for="exampleSelect1">Taxa de conversão até R$900.00 </label>
                                            <input type="text" class="form-control" id="txPgmto1" value="{{$taxavalor[0]->percentual}}"  onchange="updateTaxas($(this))" placeholder="taxa percentual">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="exampleSelect1">Taxa de conversão até R$ 3,700.00 </label>
                                            <input type="text" class="form-control" id="txPgmto2" value="{{$taxavalor[1]->percentual}}"  onchange="updateTaxas($(this))" placeholder="taxa percentual">
                                        </div>


                    </form>
                </div>
                <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a type="button" class="btn btn-primary" href="/home">Save changes</a>
      </div>
                
    </div>
  </div>
</div>
</div>




<script src="{{ asset('js/bootstrap.js') }}"></script>

   <script src="{{ asset('js/jQuery-Mask/src/jquery.mask.js') }}"></script>
   <script src="{{ asset('js/jquery.maskMoney.js') }}"></script>
   <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script>

    

    function calculaCambio(){
       var vMoedaOrigem =  $("#valorOrigem").val().replace(/,/g, '');
       var vMoedaDestino=  $("#vMoedaDestino").val();
       var taxa =  $("#taxaPercentual").val().replace(/,/g, '.');
       var tipo =  $("#tipoPagamento").val().replace(/,/g, '.');

      

       if(!isNaN(vMoedaOrigem) &&
            !isNaN(vMoedaDestino) &&
            !isNaN(taxa) &&
            tipo !== '0' 
           ){
       
        var valorBruto = vMoedaOrigem/vMoedaDestino;
        var taxaTotal = (valorBruto/100)*taxa.replace(",", '.');
        var tipoTotal = (valorBruto/100)*tipo.replace(",", '.');

        var final = valorBruto - taxaTotal - tipoTotal

        var taxaPgmtReal = (vMoedaOrigem/100)*tipo.replace(",", '.')
        var taxaConversaoReal = (vMoedaOrigem/100)*taxa.replace(",", '.')
        var valorRealGasto = vMoedaOrigem - taxaPgmtReal -taxaConversaoReal
                if(!isNaN(final)){
                        $("#vFinalDestino").val(parseFloat(final).toFixed(2))

                        $("#taxaPgmtReal").val(taxaPgmtReal)
                        $("#taxaConversaoReal").val(taxaConversaoReal)

                        $("#valorRealGasto").val(valorRealGasto)
                }
        } else{
            $("#vFinalDestino").val("")
        }

    }

    function enviaEmail(id){
            $.ajax({
                url: "/sendbasicemail/"+id,
                type: "GET",
                dataType: 'json',
                data:"",
                success: function(result){
                    
                }
            });
            alert("email Enviado!");
        };

     function updateTaxas(element){
        $.ajax({
                headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url: "taxasupdate",
                type: "POST",
                dataType: 'json',
                data:{txPgmto1 : $("#txPgmto1").val(), txPgmto2: $("#txPgmto2").val()},
                success: function(result){
                    //document.location.href = "/home";
                }
            });
     }   



    $( document ).ready(function() {

       
        $('#example').DataTable();

        
        $("#valorOrigem").change(function(){
            var valor = $(this).val();
            var taxaPercent =  ""
            
            if(valor < 900.00 ){
                alert("valor de transação menor que R$ 900.00");
                return;
            }

            if(valor.replace(/,/g, '') > 900000.00 ){
                alert("valor de transação maior que R$ 900 000.00");
                return;
            }

            $.ajax({
                headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url: "taxavalor",
                type: "POST",
                dataType: 'json',
                data:{"valor":valor},
                success: function(result){
                    $.each(result, function(index, element) {
                        $("#taxaPercentual").val(element.percentual)
                    });
                }
            });

            calculaCambio();

        }).maskMoney();
        

        $("#currencies").change(function(){
            var dest = $(this).val();
            $.ajax({
                
            url: "https://economia.awesomeapi.com.br/json/last/"+ $(this).val() + "-BRL",
            contentType: "application/json",
            dataType: 'json',
            success: function(result){
       
                $.each(result, function(index, element) {
                    $("#nomeCambio").val(element.name);
                    $("#vMoedaDestino").val(element.bid);
                    $("#dataCotacao").val(element.create_date);
                });
                calculaCambio();
            },statusCode: {
                404: function() {
                alert("page not found");
             }
            }
            })
        });


        $("#salvar").click(function(){
            
            $.ajax({
                headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url: "/cotacaosave",
                type: "POST",
                dataType: 'json',
                data:$("#frmCotacao").serialize(),
                success: function(result){
                    alert("Cotaçao Salva!");
                    document.location.href= "/home"
                
                }
            });
        });

        

        
 
        $.getJSON( "https://economia.awesomeapi.com.br/json/available/uniq", function( data ) {
            var items = [];
            $.each( data, function( key, val ) {
                items.push( "<option value='" + key + "'>" + val + "</option>" );    
            });
            $("#currencies").html(items);
        });

      
    });



</script>

@endsection
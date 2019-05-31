@extends('layouts.app')

@section('content')
    
    <div class="album py-5 bg-light">
        @if (session('message'))
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="alert alert-danger" style="text-align: center">
                        <h3><b>{{ session('message') }}</b></h3>
                    </div>
                </div>
            </div>
            <br>
        @endif  
        <h2 style="text-align: center">Processo Seletivo SEFAZ</h2>
        <p style="text-align: center">Para buscar um produto, acrescente na url acima: /v1/produtos/<i>"CÓDIGO_GTIN_SEM_ASPAS"</i></p>
        <p style="text-align: center">Para buscar um produto e ter a distância até o estabelecimento revelada, acrescente na url acima: /v1/produtos/<i>"CÓDIGO_GTIN_SEM_ASPAS"/"LATITUDE_SEM_ASPAS"/"LONGITUDE_SEM_ASPAS"</i></p>
        <br>
        <div class="container">
            <div class="row justify-content-md-center">
                <h3>
                    <a href="/v1/importar">Importar CSV</a>
                </h3>
            </div>

            <div class="row justify-content-md-center">
                <span style="font-size: 14px"><i>Obs.: Ao selecionar a opção de Importar CSV, as informações serão exportadas da planilha CSV para o banco SQLITE. Essa operação irá levar um tempo.</i></span>
            </div>
        </div>
    </div>
  
@endsection

@section('scriptAdd')
    
@endsection

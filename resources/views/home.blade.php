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
        <br>
        <div class="box-group box-body text-justify row justify-content-md-center" id="divPassoAPasso">
            <div class="panel box box-primary">
                <div class="box-header with-border row justify-content-md-center">
                    <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#divPassoAPasso" href="#collapsePassoAPasso">
                            Passo a passo
                        </a>
                    </h4>
                </div>
                
                <div id="collapsePassoAPasso" class="panel-collapse collapse">
                    <div class="box-body">
                        <p style="text-align: center">- É necessário executar o comando "composer update"</p>
                        <p style="text-align: center">- É necessário que o arquivo "dataset-processo-seletivo-2019.csv" esteja na pasta "database"</p>
                        <p style="text-align: center">- É precisar criar um arquivo vazio chamado "banco_sefaz.sqlite" na pasta "database"</p>
                        <p style="text-align: center">- O arquivo .env com as configurações necessárias está disponível nesse projeto</p>
                        <p style="text-align: center">- É necessário alterar o caminho até a pasta do projeto no arquivo .env na opção "DB_DATABASE"</p>
                        <p style="text-align: center">- Antes de clicar na opção "Importar CSV" é necessário executar o comando "php artisan migrate" na pasta do projeto</p>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <br>
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

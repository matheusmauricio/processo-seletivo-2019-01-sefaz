<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\ProdutoModel;
use App\TabelaLogModel;

use Illuminate\Http\Request;

class ProdutoController extends Controller{

    public function buscarProduto($GTIN){
        $dadosDb = ProdutoModel::orderBy('VLR_UNITARIO', 'ASC');
        $dadosDb->select('NUM_LATITUDE', 'NUM_LONGITUDE');
        $dadosDb->where('COD_GTIN', '=', $GTIN);
        $dadosDb->where('VLR_UNITARIO', '>', '0');
        $dadosDb->where('NUM_LATITUDE', '<>', 'NULL');
        $dadosDb->where('NUM_LONGITUDE', '<>', 'NULL');

        $dadosDb = $dadosDb->get();
        

        if($dadosDb->isEmpty()){
            $status_code = 400;
            $quantidade = 0;
            
            $info_log = TabelaLogModel::insert(['rota' => '/v1/produtos/{GTIN}','horario' =>  date('Y-m-d H:i:s'), 'cod_gtin' => $GTIN, 'status_code' => $status_code, 'quantidade_produtos' => $quantidade]);
            
            // Erro 400 (Bad Request)
            abort(400, '400 (Bad Request)');
        } else{
            $status_code = 200;
            $quantidade = count($dadosDb);
            
            $info_log = TabelaLogModel::insert(['rota' => '/v1/produtos/{GTIN}', 'horario' =>  date('Y-m-d H:i:s'), 'cod_gtin' => $GTIN, 'status_code' => $status_code, 'quantidade_produtos' => $quantidade]);


            foreach ($dadosDb as $valor) {
                $valor->url = "https://maps.google.com/maps?q=" . $valor->NUM_LATITUDE . "," . $valor->NUM_LONGITUDE;
                
                // Apaga os campos latitude e longitude do json
                unset($valor->NUM_LATITUDE);
                unset($valor->NUM_LONGITUDE);
            }
            
            return json_encode($dadosDb, JSON_UNESCAPED_UNICODE);
        }
    }

    public function buscarProdutoLatLng($GTIN, $latitude, $longitude){
        $dadosDb = ProdutoModel::orderBy('VLR_UNITARIO', 'ASC');
        $dadosDb->select('NUM_LATITUDE', 'NUM_LONGITUDE');
        $dadosDb->where('COD_GTIN', '=', $GTIN);
        $dadosDb->where('VLR_UNITARIO', '>', '0');
        $dadosDb->where('NUM_LATITUDE', '<>', 'NULL');
        $dadosDb->where('NUM_LONGITUDE', '<>', 'NULL');

        $dadosDb = $dadosDb->get();
        

        if($dadosDb->isEmpty()){
            $status_code = 400;
            $quantidade = 0;
            
            $info_log = TabelaLogModel::insert(['rota' => '/v1/produtos/{GTIN}/{latitude}/{longitude}', 'horario' =>  date('Y-m-d H:i:s'), 'cod_gtin' => $GTIN, 'status_code' => $status_code, 'quantidade_produtos' => $quantidade]);

            // Erro 400 (Bad Request)
            abort(400, '400 (Bad Request)');
        } else{
            $status_code = 200;
            $quantidade = count($dadosDb);
            
            $info_log = TabelaLogModel::insert(['rota' => '/v1/produtos/{GTIN}/{latitude}/{longitude}', 'horario' =>  date('Y-m-d H:i:s'), 'cod_gtin' => $GTIN, 'status_code' => $status_code, 'quantidade_produtos' => $quantidade]);


            foreach ($dadosDb as $valor) {
                $valor->url = "https://maps.google.com/maps?q=" . $valor->NUM_LATITUDE . "," . $valor->NUM_LONGITUDE;
                $valor->distancia = $this->calculaDistancia($valor->NUM_LATITUDE, $valor->NUM_LONGITUDE, $latitude, $longitude);
                
                // Apaga os campos latitude e longitude do json
                unset($valor->NUM_LATITUDE);
                unset($valor->NUM_LONGITUDE);
            }
            
            return json_encode($dadosDb, JSON_UNESCAPED_UNICODE);
        }
    }

    public function importarCSV(){
        // Apaga os dados existentes no banco antes de importar os dados da planilha
        $this->apagaBanco();

        $file = database_path('dataset-processo-seletivo-2019.csv');
        $dadosTabela = $this->csvToArray($file);
        
        $status_code = 200;
        $quantidade = count($dadosTabela);
        
        $info_log = TabelaLogModel::insert(['rota' => '/v1/importar', 'horario' =>  date('Y-m-d H:i:s'), 'cod_gtin' => '', 'status_code' => $status_code, 'quantidade_produtos' => $quantidade]);

        foreach($dadosTabela as $dados){
            // Resetando o tempo máximo de execução a cada inserção, para não dar timeout
            ini_set('max_execution_time', 300 ) ;

            ProdutoModel::insert($dados);
        }

        return redirect('/')->with('message', 'Importação concluída!');
    }

    function csvToArray($nomeArquivo = ''){
        $delimitador = ',';

        if (!file_exists($nomeArquivo) || !is_readable($nomeArquivo)){
            return false;
        }
        
        $header = null;
        $dados = array();

        if (($handle = fopen($nomeArquivo, 'r')) !== false){
            while (($linha = fgetcsv($handle, 1000, $delimitador)) !== false){
                if (!$header){
                    $header = $linha;
                }else{
                    $dados[] = array_combine($header, $linha);
                }
            }
            fclose($handle);
        }

        return $dados;
    }

    function apagaBanco(){
        $dadosDb = ProdutoModel::orderBy('COD_GTIN');
        $dadosDb->delete();
    }

    function calculaDistancia($lat1, $lng1, $lat2, $lng2){
        $lat1 = deg2rad((float) $lat1);
        $lat2 = deg2rad((float) $lat2);
        $lng1 = deg2rad((float) $lng1);
        $lng2 = deg2rad((float) $lng2);
        
        $distancia = (6371 * acos( cos( $lat1 ) * cos( $lat2 ) * cos( $lng2 - $lng1 ) + sin( $lat1 ) * sin($lat2) ) );
        $distancia = number_format($distancia, 2, '.', '');
        
        return $distancia . " KM";
    }

}

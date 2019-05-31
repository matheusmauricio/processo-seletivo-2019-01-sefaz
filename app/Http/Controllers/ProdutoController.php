<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\ProdutoModel;

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
            // Erro 400 (Bad Request)
            abort(400, '400 (Bad Request)');
        } else{
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
            // Erro 400 (Bad Request)
            abort(400, '400 (Bad Request)');
        } else{
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
        // APAGA OS DADOS EXISTENTES NO BANCO ANTES DE IMPORTAR OS DADOS DA PLANILHA
        $dadosDb = ProdutoModel::orderBy('COD_GTIN');
        $dadosDb->delete();

        $file = database_path('dataset-processo-seletivo-2019.csv');
        $dadosTabela = $this->csvToArray($file);
        
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

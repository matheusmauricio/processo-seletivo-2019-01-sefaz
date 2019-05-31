<?php

namespace App\Http\Middleware;

use Closure;
use App\TabelaLogModel;

class VerificaParametros{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $status_code = 400;
        $quantidade = 0;

        if(count($request->route()->parameters()) < 1){    
            $info_log = TabelaLogModel::insert(['rota' => '/v1/produtos','horario' =>  date('Y-m-d H:i:s'), 'cod_gtin' => '', 'status_code' => $status_code, 'quantidade_produtos' => $quantidade]);

            return redirect('/')->with('message', 'É necessário passar algum parâmetro para essa rota!');
        } else if(count($request->route()->parameters()) == 2){
            $info_log = TabelaLogModel::insert(['rota' => '/v1/produtos/{parametro1}/{parametro2}','horario' =>  date('Y-m-d H:i:s'), 'cod_gtin' => '', 'status_code' => $status_code, 'quantidade_produtos' => $quantidade]);

            return redirect('/')->with('message', 'Por favor verifique se você colocou os parâmetros corretamente');
        } else if(count($request->route()->parameters()) > 3){
            $info_log = TabelaLogModel::insert(['rota' => '/v1/produtos/{múltiplos parâmetros}','horario' =>  date('Y-m-d H:i:s'), 'cod_gtin' => '', 'status_code' => $status_code, 'quantidade_produtos' => $quantidade]);
            
            return redirect('/')->with('message', 'Por favor verifique se você colocou os parâmetros corretamente');
        }

        return $next($request);
    }
}

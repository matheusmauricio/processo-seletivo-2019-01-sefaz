<?php

namespace App\Http\Middleware;

use Closure;

class VerificaParametros
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if(count($request->route()->parameters()) < 1){
            return redirect('/')->with('message', 'É necessário passar algum parâmetro para essa rota!');
        } else if(count($request->route()->parameters()) == 2){
            return redirect('/')->with('message', 'Por favor verifique se você colocou os parâmetros corretamente');
        } else if(count($request->route()->parameters()) > 3){
            return redirect('/')->with('message', 'Por favor verifique se você colocou os parâmetros corretamente');
        }

        return $next($request);
    }
}

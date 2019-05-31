@extends('layouts.app')

@section('content')

    <h2>Página de lista de produtos</h2>

    @isset($result_json)
        {{result_json}}
    @endisset


@endsection

@section('scriptAdd')
    
@endsection

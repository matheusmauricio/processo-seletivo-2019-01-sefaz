@extends('layouts.app')

@section('content')

    <div class="row">
        <div class=col-md-12>
            <h1 class="error" style="text-align: center"><strong>{{ $exception->getMessage() }}</strong></h1>   
        </div>
    </div>
      
@endsection

@section('scriptsadd')
@endsection
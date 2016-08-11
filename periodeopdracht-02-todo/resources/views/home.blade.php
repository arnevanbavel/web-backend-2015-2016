@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <p>
                      Hallo {{ Auth::user()->name }}.
                    </p>
                    <p>
                      Welkom op mijn <i>todo app</i> deze app biedt je een manieren om je todo's te beheren.
                    </p>
                    <p>
                      <a href="{{ url('/test') }}">Klik hier voor naar de todo lijst te gaan </a> 
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts/app')

@section('content')
    <h1>Create Artikel</h1>

        <div class="panel-body">
          {!! Form::open(['route' => 'artikels.store', 'files' => true])!!}
            @include('artikel._form')
          {!! Form::close() !!}
        </div>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@stop
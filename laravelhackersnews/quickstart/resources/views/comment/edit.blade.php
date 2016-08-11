@extends('layouts/app')

@section('content')
    <h1>Update Artikel</h1>

        <div class="panel-body">
          {!! Form::model($artikel, ['route' => ['artikels.update', $artikel], 'method' =>'patch', 'files' => true])!!}
            @include('artikel._form', ['model' => $artikel])
          {!! Form::close() !!}
        </div>
        
        {!! Form::model($artikel, ['route' => ['artikels.destroy', $artikel], 'method' => 'delete', 'class' => 'form-inline'] ) !!}
                  <i class="glyphicon glyphicon-trash" style="padding-left: 15px;"><button type="submit" class="delete-button" value="Delete"></button>
                {!! Form::close()!!}
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@stop
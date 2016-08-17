@extends('layouts/app')

@section('content')
@if(Session::has('notiftype'))
<div class="container">
  <div class="alert alert-{{{ Session::pull('notiftype') }}} fade in col-sm-offset-1 col-sm-10">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{{ Session::pull('notifmessage') }}} 
        @if(Session::pull('delete'))
            <a class='btn btn-warning btn-xs pull-right' href="{{ action('ArtikelsController@edit', $artikel->id) }}">Cancel </a>
            <a class='btn btn-danger btn-xs pull-right' href="{{ url('artikeldelete/'.$artikel->id ) }}"><span class="glyphicon glyphicon-trash"></span> Delete</a>
        @endif
  </div>
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <a href="{{ url('/comment') }}"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> back to overview</a>
            <div class="panel panel-default">
                <div class="panel-heading">Edit artikel <a class='btn btn-danger btn-xs pull-right' href="{{ url('delete')}}/{{$artikel->id }}}}">
                                 <span class="glyphicon glyphicon-trash"></span> 
                            Delete</a></div>        
                    <div class="panel-body">
                      {!! Form::model($artikel, ['route' => ['artikels.update', $artikel], 'method' =>'patch', 'files' => true])!!}
                        @include('artikel._form', ['model' => $artikel])
                      {!! Form::close() !!}
                    </div>
                             
                @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                        <span class="fault">
                            <strong>{{ $error }}</strong>
                        </span>
                        @endforeach
                    </ul>
                @endif
            @stop
            </div>
        </div>
    </div>
</div>
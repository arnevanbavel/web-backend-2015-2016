@extends('layouts/app')

@section('content')
@if (Session::has('notiftype'))
<div class="container">
  <div class="alert alert-{{{ Session::pull('notiftype') }}} fade in col-sm-offset-1 col-sm-10">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{{ Session::pull('notifmessage') }}}
  </div>
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <a href="{{ url('/home') }}"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> back to overview</a>
            <div class="panel panel-default">
                <div class="panel-heading">Create Artikel</div>
                    <div class="panel-body">
                      {!! Form::open(['route' => 'artikels.store', 'files' => true])!!}
                        @include('artikel._form')
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
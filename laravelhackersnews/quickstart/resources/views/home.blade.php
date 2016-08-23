@extends('layouts.app')

@section('content')
@if (Session::has('notiftype'))
<div class="container">
  <div id="alert-{{{ Session::pull('notiftype') }}}" class="alert alert-{{{ Session::get('notiftype') }}} fade in col-sm-offset-1 col-sm-10">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::pull('notifmessage') }}
  </div>
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Article overview</div>

                <div class="panel-body">
                        @foreach($artikels as $artikel)
                            @include('partials/artikel')
                        @endforeach
                    @if(!Auth::check())  
                        <p>You need to be <a href="{{ url('/login') }}">logged in</a> to vote or comment</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

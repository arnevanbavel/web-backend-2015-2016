@extends('layouts/app')

@section('content')
@if(Session::has('notiftype'))
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
                <div class="panel-heading">Article: {{ $artikel->title }}</div>
                <div class="panel-body">
                    <div class="col-md-1">
                            @include('partials/buttons')
                        </div>
                        <div class="col-md-10">
                            <p>
                                    <a href="http://{{ $artikel->link }}" target="_blank">{{ $artikel->title }}</a> 
                            </p>
                            <p style="color: darkgrey; font-size: 12px;">
                                <i class="glyphicon glyphicon-user" style="padding-right: 5px;"></i>submitted by {{ $artikel->user->name}}
                                <i class="glyphicon glyphicon-calendar" style="padding-left: 15px;"></i> {{ $artikel->created_at->diffForHumans() }}
                                <i class="glyphicon glyphicon-comment" style="padding-left: 15px;"></i> {{ $artikel->comments->count() }} Comments
                                @if(Auth::check())
                                @if ($artikel->user->name == Auth::user()->name )
                                    <i class="glyphicon glyphicon-pencil" style="padding-left: 15px;"></i> <a href="{{ action('ArtikelsController@edit', $artikel->id) }}">Edit</a>
                                @endif
                                @endif
                            </p>
                            <hr>
                        </div>
                        <div class="comments">
                            <br>
                                <h2> comment (s)</h2>
                             @if($artikel->comments->count() == 0)
                                <p> No comments yet</p>
                            @endif
                                                  
                            @foreach($comments as $comment)
                                <div>- {{$comment->comment}}
                                <p style="color: darkgrey; font-size: 12px;">
                                    
                                    <i class="glyphicon glyphicon-calendar" style="padding-left: 15px;"></i> {{ $comment->created_at }}
                                    <i class="glyphicon glyphicon-user" style="padding-left: 15px;"> {{ $comment->user->name }}</i> 
                                    @if(Auth::check())
                                    @if ($comment->user->name == Auth::user()->name )
                                        <i class="glyphicon glyphicon-pencil" style="padding-left: 15px;"></i> <a href="{{ url('comment/edit', $comment->id)}}">Edit</a>
                                    @endif
                                    @endif
                                    
                
                                </p>
                                </div>
                            @endforeach
                        @if(Auth::check())  
                            {!! Form::open(['route' => 'comment.store', 'files' => true])!!}
                                    {{ Form::hidden('artikel_id', $artikel->id) }}
                                    @include('comment._form')
                            {!! Form::close() !!}
                        @else
                        <p>You need to be <a href="{{ url('/login') }}">logged in</a> to comment</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
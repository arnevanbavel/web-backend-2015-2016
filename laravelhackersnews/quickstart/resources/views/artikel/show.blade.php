@extends('layouts/app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="http://{{ $artikel->link }}" target="_blank">{{ $artikel->title }}</a></div>

                <div class="panel-body">
                        <h2> comment (s)</h2>
                        @foreach($comments as $comment)
                            <div>- {{$comment->comment}}
                            <p style="color: darkgrey; font-size: 12px;">
                                
                                <i class="glyphicon glyphicon-calendar" style="padding-left: 15px;"></i> {{ $comment->created_at }}
                                <i class="glyphicon glyphicon-user" style="padding-left: 15px;"> {{ $comment->user->name }}</i> 
                                @if(Auth::check())
                                @if ($comment->user->name == Auth::user()->name )
                                    <i class="glyphicon glyphicon-pencil" style="padding-left: 15px;"></i> <a href="{{ action('CommentController@edit', $artikel->id) }}">Edit</a>
                                @endif
                                @endif
                                
            
                            </p>
                            </div>
                        @endforeach
                    
                    {!! Form::open(['route' => 'comment.store', 'files' => true])!!}
                            {{ Form::hidden('artikel_id', $artikel->id) }}
                            @include('comment._form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
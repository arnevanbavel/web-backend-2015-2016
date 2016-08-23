@extends('layouts/app')

@section('content')
@if(Session::has('notiftype'))
<div class="container">
  <div class="alert alert-{{{ Session::pull('notiftype') }}} fade in col-sm-offset-1 col-sm-10">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{{ Session::pull('notifmessage') }}} 
        @if(Session::pull('delete'))
            <a class='btn btn-warning btn-xs pull-right' href="{{ action('CommentController@edit', $comment->id) }}">Cancel </a>
            <a class='btn btn-danger btn-xs pull-right' href="{{ url('commentdeletetrue/'.Session::get('commentid').'/'.$comment->artikel_id)}}"><span class="glyphicon glyphicon-trash"></span>Delete</a> 
        @endif
  </div>
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <a href="{{ url('/comment') }}/{{$comment->artikel_id}}"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> back to article</a>
            <div class="panel panel-default">
                <div class="panel-heading">Edit Comment <a class='btn btn-danger btn-xs pull-right' href="{{ url('commentdelete')}}/{{$comment->id }}}}">
                                 <span class="glyphicon glyphicon-trash"></span> 
                            Delete</a></div>        
                        <div class="panel-body">
                          {!! Form::model($comment, ['route' => ['comment.update', $comment], 'method' =>'patch', 'files' => true])!!}
                            {{ Form::hidden('artikel_id', $comment->artikel_id) }}
                            @include('comment._form', ['model' => $comment])
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
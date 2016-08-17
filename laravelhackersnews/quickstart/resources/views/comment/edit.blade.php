@extends('layouts/app')

@section('content')
<div class="container">
    <a href="{{ url('/comment') }}/{{$comment->artikel_id}}">back to article</a>
</div>
@if (Session::has('notiftype'))
<div class="container">
  <div class="alert alert-{{{ Session::get('notiftype') }}} fade in col-sm-offset-1 col-sm-10">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{{ Session::pull('notifmessage') }}}
  </div>
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Comment</div>
                        <div class="panel-body">
                          {!! Form::model($comment, ['route' => ['comment.update', $comment], 'method' =>'patch', 'files' => true])!!}
                            {{ Form::hidden('artikel_id', $comment->artikel_id) }}
                            @include('comment._form', ['model' => $comment])
                          {!! Form::close() !!}
                        </div>
                        
                        {!! Form::model($comment, ['route' => ['comment.destroy', $comment], 'method' => 'delete', 'class' => 'form-inline'] ) !!}
                                  <i class="glyphicon glyphicon-trash" style="padding-left: 15px;"></i><button type="submit" class="delete-button">Delete</button>
                                {!! Form::close()!!}
                    @if($errors->any())
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                @stop
            </div>
            
        </div>
    </div>
</div>
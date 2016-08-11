@extends('layouts/app')

@section('content')

                    <h1>Edit Comment</h1>
                        <a href="{{ url('/comment') }}/{{$comment->artikel_id}}">back</a>
                        <div class="panel-body">
                          {!! Form::model($comment, ['route' => ['comment.update', $comment], 'method' =>'patch', 'files' => true])!!}
                            {{ Form::hidden('artikel_id', $comment->artikel_id) }}
                            @include('comment._form', ['model' => $comment])
                          {!! Form::close() !!}
                        </div>
                        
                        {!! Form::model($comment, ['route' => ['comment.destroy', $comment], 'method' => 'delete', 'class' => 'form-inline'] ) !!}
                                  <i class="glyphicon glyphicon-trash" style="padding-left: 15px;"><button type="submit" class="delete-button">Delete</button>
                                {!! Form::close()!!}
                    @if($errors->any())
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                
@stop
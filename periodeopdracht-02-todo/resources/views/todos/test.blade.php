
@extends('layouts.app')

@section('content')

@if (Session::has('notiftype'))
<div class="container">
  <div class="alert alert-{{{ Session::get('notiftype') }}} fade in col-sm-offset-1 col-sm-10">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>{{{ Session::pull('notiftype') }}}!</strong> {{{ Session::pull('notifmessage') }}}
  </div>
</div>
@else
@if ($todos->count()==0)
  <div class="container">
    <div class="alert alert-info fade in col-sm-offset-1 col-sm-10">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Hey!</strong> Je hebt nog geen todos voeg er snel toe en ga aan het werk.
    </div>
  </div>
@endif
@if ($todos->where('completed', 0)->count() == 0 && $todos->count()!=0)
<div class="container">
  <div class="alert alert-success fade in col-sm-offset-1 col-sm-10">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Euuuuuujjj!</strong> Je bent klaar met al je taken, We zijn trots op jouw. <i class="fa fa-smile-o"></i>
  </div>
</div>
@endif

@endif

<form action="{{ url('teststore') }}" method="POST" class="form-horizontal">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="todo-name" class="col-sm-3 control-label">Todo</label>
    <div class="col-sm-3">
      <input type="text" name="name" id="todo-name" class="form-control">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-6">
      <button type="submit" class="btn btn-default">
        <i class="fa fa-plus"></i> Add todo
      </button>
    </div>
  </div>
</form>

<div class="col-sm-offset-3 col-sm-1">
  <section class="todo">
    <ul class="todo-list">
      @foreach ($todos as $todo)
      <li><a href="{{ url('testdelete/'.$todo->id) }}">  <i class="fa fa-trash-o"></i></a>&nbsp;&nbsp;<a href="{{ url('testcomplete/'.$todo->id) }}">
        @if ($todo->completed  == 0)<i class="fa fa-square-o"></i>
        @else<i class="fa fa-check-square-o"></i>
        @endif  {{ $todo->name }}</a>
      </li>
      @endforeach
    </ul>

    @if ($todos->count()!=0)
      <ul class="todo-pagination">
    			<li class="previous">
            @if ($todos->previousPageUrl())
    			  <a href="{{$todos->previousPageUrl()}}">
              <i class="fa fa-arrow-left"></i> Previous</a>
    			@else
    			  <span>
              <i class="fa fa-arrow-left"></i> Previous</span>
    			@endif
            </li>
            <li>&nbsp;&nbsp;{{{ $todos->currentPage() }}} van de <?php echo ceil($todos->total()/10) ?> </li>
    			<li class="next">
            @if ($todos->nextPageUrl())
              <a href="{{$todos->nextPageUrl()}}">Next <i class="fa fa-arrow-right"></i></a>
            @else
              <span>Next <i class="fa fa-arrow-right"></i></span>
            @endif

          </li>
    		</ul>
    @endif

  </section>
</div>
@endsection

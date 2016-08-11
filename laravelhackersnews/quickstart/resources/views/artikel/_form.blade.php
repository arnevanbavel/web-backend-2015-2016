
<ul>
    <li class="form-field">
        <div class="{!! $errors->has('name') ? 'has-error' : '' !!}">
          {!! Form::label('title', 'Title:') !!}
          {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title']) !!}
          {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </li>
    <li class="form-field">
        <div class="{!! $errors->has('model') ? 'has-error' : '' !!}">
          {!! Form::label('link', 'Link:') !!}
          {!! Form::text('link', null, ['class' => 'form-control', 'id' => 'link']) !!}
          {!! $errors->first('model', '<p class="help-block">:message</p>') !!}
        </div>
    </li>
    <li class="form-field">
        <div class="align-button">
        {!! Form::submit('Verzenden', ['id' => 'submit', 'class' => 'btn btn-primary']) !!}
        </div>
    </li>
</ul>
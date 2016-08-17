
<li class="form-field">
    <div class="{!! $errors->has('model') ? 'has-error' : '' !!}">
          {!! Form::label('comment', 'Comment:') !!}
          {!! Form::text('comment', null, ['class' => 'form-control', 'id' => 'link']) !!}
          {!! $errors->first('model', '<p class="help-block">:message</p>') !!}
    </div>
</li>
<li class="form-field">
    <div class="align-button">
        {!! Form::submit('Verzenden', ['id' => 'submit', 'class' => 'btn btn-primary']) !!}
    </div>
</li>

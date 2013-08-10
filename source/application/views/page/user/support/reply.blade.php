{{ Form::open() }}

{{ Form::label('message', 'Reply message') }}
{{ Form::textarea('message', '', array('class'=>'input-block-level') ) }}

{{ Form::button('Submit reply', array('class'=>'btn btn-danger btn-small') ) }}

{{ Form::close() }}
@layout('main')


@section('content')
<div style="width:500px; margin: 0 auto;">
{{ Form::open() }}

{{ Form::label('email', 'Your email address') }}
{{ Form::email('email','', array('class'=> 'input-block-level')) }}

{{ Form::label('subject', 'What is it about?') }}
{{ Form::text('subject','', array('class'=> 'input-block-level')) }}

{{ Form::label('message', 'Your message, question or anything else') }}
{{ Form::textarea('message','', array('class'=> 'input-block-level')) }}

<?php $c = rand(10000,99999); ?>
{{ Form::label('captcha', 'You\'re no bot, are you? Prove it') }}
<img src="/captcha/{{ $c }}" /><br/>
{{ Form::text('captcha','', array('class'=>'input-small')) }}
{{ Form::hidden('captcha_key', $c) }}

<br/>
{{ Form::submit('Send', array('class' => 'btn btn-danger') ) }}




{{ Form::close() }}
</div>
@endsection
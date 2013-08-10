@layout('user')


@section('content')

<p>
    Fill in the email address you registered with and we'll send you your username and new password!
</p>
{{ Form::open() }}

{{ Form::label('emailaddress', 'Email address') }}
<div class="input-prepend">
    <span class="add-on"><i class="icon-envelope"></i></span>
    {{ Form::email('emailaddress') }}
</div><br />
{{ Form::button('Send request', array('class'=>'btn btn-danger btn-small btn-block') ) }}

{{ Form::close() }}
<span style="font-size:75%; width:100%; text-align: center">remember them? <a href="/user/login">Login!</a></span>


@endsection
@layout('user')


@section('content')
<h4>Register</h4>

    <div style="width:248px;">

        {{ Form::open() }}

        {{ Form::label('username', 'Username') }}
        <div class="input-prepend">
            <span class="add-on"><i class="icon-user"></i></span>
        {{ Form::text('username') }}
        </div>
        {{ Form::label('password', 'Password') }}
        <div class="input-prepend">
            <span class="add-on"><i class="icon-lock"></i></span>
        {{ Form::password('password') }}
        </div>
        {{ Form::label('confirm_password', 'Confirm password') }}
        <div class="input-prepend">
            <span class="add-on"><i class="icon-lock"></i></span>
        {{ Form::password('confirm_password') }}
        </div>

        {{ Form::label('emailaddress', 'Email address') }}
        <div class="input-prepend">
            <span class="add-on"><i class="icon-envelope"></i></span>
            {{ Form::email('emailaddress') }}
        </div>

        <br />
        {{ Form::button('Register', array('class' => 'btn btn-danger btn-block')) }}
        <span style="font-size:75%; width:100%; text-align: center">or <a href="/user/login">login</a></span>

        {{ Form::close() }}
    </div>

@endsection
@layout('user')


@section('content')
    <h4>Login</h4>

    <div style="width:248px; margin:0 auto">
        {{ Form::open('/user/login') }}

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
        <br />
        {{ Form::button('Login', array('class' => 'btn btn-danger btn-block')) }}
        <span style="font-size:75%; width:100%; text-align: center">or <a href="/user/register">register</a></span>
        <span style="font-size:75%;" class="pull-right"><a href="/user/forgot">Forgot credentials?</a></span>

        {{ Form::close() }}

    </div>




@endsection
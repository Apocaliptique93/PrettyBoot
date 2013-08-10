@layout('main')

@section('content')

<div class="span12">
    <div class="span3">
        <h4>Change password</h4>
        {{ Form::open('/user/changepw') }}

        {{ Form::label('old_password', 'Current password') }}
        {{ Form::password('old_password') }}

        {{ Form::label('new_password', 'New password') }}
        {{ Form::password('new_password') }}

        {{ Form::label('confirm_new_password', 'Confirm new password') }}
        {{ Form::password('confirm_new_password') }}
        <br />
        {{ Form::button('Change password', array('class'=>'btn btn-danger btn-block btn-small') ) }}

        {{ Form::close() }}
    </div>

    <div class="span3 offset1">
        <h4>Change email address</h4>
        {{ Form::open('user/changeea') }}

        {{ Form::label('emailaddress', 'New email address') }}
        {{ Form::email('emailaddress') }}

        <br />
        {{ Form::button('Change email address', array('class'=>'btn btn-danger btn-block btn-small') ) }}

        {{ Form::close() }}
    </div>
</div>

@endsection
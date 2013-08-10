@layout('main')


@section('content')

<div class="span11 offset1">
<h3>Booter methods</h3>

    {{ Form::open() }}
    {{ Form::label('methods', 'Seperate methods with a new line') }}
    {{ Form::textarea('methods', $methods) }}
    <br />
    {{ Form::button('Update methods', array('class'=>'btn btn-danger btn') ) }}
    {{ Form::close() }}
</div>


@endsection
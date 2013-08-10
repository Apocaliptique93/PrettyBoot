@layout('main')


@section('content')
<h3>Create a new plan</h3>
{{ Form::open() }}

    {{ Form::label('name', 'Name') }}
    {{ Form::text('name') }}

    {{ Form::label('price', 'Price (decimals with a period -> 0.5)') }}
    {{ Form::text('price') }}

    {{ Form::label('days', 'Length in days') }}
    {{ Form::text('days') }}

    {{ Form::label('time', 'Boot time') }}
    {{ Form::text('time') }}

    {{ Form::label('desc', 'Description of the plan') }}
    {{ Form::textarea('desc') }}

    {{ Form::label('concurrent', 'Amount of concurrent attacks allowed') }}
    {{ Form::text('concurrent') }}
    <br />
    {{ Form::button('Create plan', array('class' => 'btn btn-danger', 'style' => 'width:220px;')) }}

{{ Form::close() }}

@endsection
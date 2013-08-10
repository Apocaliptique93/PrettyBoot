@layout('main')

@section('content')

<h3>Edit plan</h3>
{{ Form::open() }}

{{ Form::label('name', 'Name') }}
{{ Form::text('name', $plan->name) }}

{{ Form::label('price', 'Price (decimals with a period -> 0.5)') }}
{{ Form::text('price', $plan->price) }}

{{ Form::label('days', 'Length in days') }}
{{ Form::text('days', $plan->days) }}

{{ Form::label('time', 'Boot time') }}
{{ Form::text('time', $plan->time) }}


{{ Form::label('desc', 'Description of the plan') }}
{{ Form::textarea('desc', $plan->desc) }}
{{ Form::label('concurrent', 'Amount of concurrent attacks allowed') }}
{{ Form::text('concurrent', $plan->concurrent) }}
<br />
{{ Form::button('Edit plan', array('class' => 'btn btn-danger', 'style' => 'width:220px;')) }}


@endsection
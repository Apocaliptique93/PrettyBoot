@layout('main')


@section('content')
<div class="span4 offset1">
    <h3>Skype resolver API</h3>
    {{ Form::open() }}
        {{ Form::label('api', 'Your API link') }}
        {{ Form::text('api', $settings['skypeapi'], array('placeholder'=>'http://skype-api.com/api.php?apikey=123&username=') ) }}
        <br />
        {{ Form::button('Edit API', array('class'=>'btn btn-danger btn-small') ) }}
    {{ Form::close() }}
</div>
<div class="span3">
    <h3>Instructions</h3>
    <p>If you have an API yourself, please enter it in here.
    <br/>
    If you do not, leave the field empty to use the built in one.
    <br /><br />
    Please note, the built in one can be less reliable than one of yourself</p>
</div>
@endsection
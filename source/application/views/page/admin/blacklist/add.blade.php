@layout('main')


@section('content')
<div class="span3 offset1">
    <h4>Block hosts from being attacked</h4>
    {{ Form::open() }}

    {{ Form::label('host', 'Hosts to block') }}
    {{ Form::textarea('host', '', array('class' => 'span3', 'style' => 'max-width:220px; height:300px;')) }}

    {{ Form::button('Add hosts to blocked list', array('class' => 'btn btn-danger btn-block')) }}

</div>
<div class="span4 offset1" style="margin-top: 50px;">
    <ul>
        <li>Add hosts here that shouldn't get attacked</li>
        <li>Divide each hosts with a new line</li>
        <li>Duplicate hosts won't give any errors</li>
        <li>Want to add a description? Just separate the IP address and the description by a simple "="</li>
        <li>
            Example: 192.168.1.210=Home address
        </li>
    </ul>
</div>
@endsection
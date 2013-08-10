@layout('main')


@section('script')

    <script>

        $(document).ready( function()
        {

            setInterval( function()
            {

                var txt = $('#result_url');
                var url = $('#url').val();
                var host = $('#host').val();
                var time = $('#time').val();
                var port = $('#port').val();
                var method = $('#method').val();
                var custom = $('#custom').val();

                if(url == '') return;

                var result = url + '?' + host + '=HOST&' + time + '=TIME&' + port + '=PORT&' + method + '=METHOD&' + custom;

                txt.html(result);

            }, 100);

        });

    </script>

@endsection

@section('content')
<div class="row">
<div class="span2">
    <h3>Add server/API</h3>
    {{ Form::open() }}

    {{ Form::label('url', 'Server URL') }}
    {{ Form::text('url', '', array('placeholder' => ('http://'.$_SERVER['SERVER_NAME'].'/api.php'))) }}

    {{ Form::label('host', 'Host parameter') }}
    {{ Form::text('host', 'host', array('class' => 'input-small')) }}

    {{ Form::label('time', 'Time parameter') }}
    {{ Form::text('time', 'time', array('class' => 'input-small')) }}

    {{ Form::label('port', 'Port parameter') }}
    {{ Form::text('port', 'port', array('class' => 'input-small')) }}

    {{ Form::label('method', 'Method parameter') }}
    {{ Form::text('method', 'method', array('class' => 'input-small')) }}

    {{ Form::label('custom', 'Custom parameter(s)') }}
    {{ Form::text('custom', '', array('placeholder' => 'apikey=123key321&user=John')) }}
        <br />

    {{ Form::button('Add server/API', array('class' => 'btn btn-danger', 'style' => 'width:220px;')) }}
    {{ Form::close() }}
</div>

<div class="span8 offset1">
    <h3>Instructions</h3>
    <ol>
        <li>Fill in the URL of the API, example http://{{$_SERVER['SERVER_NAME']}}/api.php</li>
        <li>Fill in the host parameter of the API, default is "host".</li>
        <li>Fill in the time parameter of the API, default is "time".</li>
        <li>Fill in the port parameter of the API, default is "port".</li>
        <li>If the api requires any custom parameters, enter them in the "custom" field.</li>
        <li>Check if the result link looks like it should, if so click the "Add server/API" button</li>
    </ol>

    <div style="margin-top:50px;">
        <h3>Result</h3>
        The URL will be saved like this:
        <br />
        <br />
        <span id="result_url">Nothing entered yet</span>

    </div>
</div>
</div>
@endsection


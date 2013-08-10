@layout('main')



@section('content')

<div class="span12">

    <div class="span4 offset1">
        <h3>Skype blacklisting price</h3>
        <div style="margin-top:25px">
            {{ Form::open('/admin/plan/skypebl') }}
            {{ Form::label('price', 'Skype blacklist price in set currency') }}
            {{ Form::text('price', $settings['skypebl'], array('class'=>'input-level-block') ) }}
            <br />
            {{ Form::button('Set price', array('class'=>'btn btn-danger btn-small') ) }}
            {{ Form::close() }}
        </div>
    </div>

    <div class="span4 offset1">
        <h3>IP blacklisting price</h3>
        <div style="margin-top:25px">
            {{ Form::open('/admin/plan/ipbl') }}
            {{ Form::label('price', 'IP address blacklist price in set currency') }}
            {{ Form::text('price', $settings['ipbl'], array('class'=>'input-level-block') ) }}
            <br />
            {{ Form::button('Set price', array('class'=>'btn btn-danger btn-small') ) }}
            {{ Form::close() }}
        </div>
    </div>

</div>

@endsection
@layout('main')



@section('content')

<div class="row">
    <div class="span12">
        <div class="span3">
            <h4>Licence key</h4>
            {{ Form::open('admin/settings/key') }}

                {{ Form::label('key', 'Your licence key') }}
                {{ Form::text('key', $settings['idkey'], array('class' => 'input-block-level')) }}
                <br />
                {{ Form::button('Set key', array('class' => 'btn btn-danger btn-block btn-small')) }}
            {{ Form::close() }}
        </div>
        <div class="span3 offset1">
            <h4>Page title</h4>
            {{ Form::open('admin/settings/title') }}

                {{ Form::label('title', 'The window\'s page title') }}
                {{ Form::text('title', $settings['pagetitle'], array('class' => 'input-block-level', 'placeholder' => 'PrettyBoot')) }}
                {{ Form::button('Set page title', array('class' => 'btn btn-danger btn-block btn-small')) }}
            {{ Form::close() }}
        </div>
        <div class="span3 offset1">
            <h4>Logo parts</h4>
            {{ Form::open('admin/settings/logo') }}
                {{ Form::label('part1', 'Parts of logo') }}
                {{ Form::text('part1', $settings['name_part1'], array('class' => 'input-small pull-left', 'placeholder' => 'Pretty')) }}
                {{ Form::text('part2', $settings['name_part2'], array('class' => 'input-small pull-left', 'placeholder' => 'Boot')) }}
                {{ Form::button('Set logo parts', array('class' => 'btn btn-danger btn-block btn-small')) }}
            {{ Form::close() }}
        </div>
        <div class="span3">
            <h4>Mail address</h4>
            {{ Form::open('admin/settings/mail') }}
                {{ Form::label('mail', 'The mail address to show in case of errors') }}
                {{ Form::text('mail', $settings['admin_mail'], array('class' => 'input-block-level', 'placeholder' => 'admin@prettyboot.com')) }}
                {{ Form::button('Set mail address', array('class' => 'btn btn-danger btn-block btn-small')) }}
            {{ Form::close() }}
        </div>

        <div class="span3 offset1">
            <h4>PayPal settings</h4>
            {{ Form::open('admin/settings/paypal') }}
                {{ Form::text('ppemail', $settings['ppemail'], array('class' => 'input-block-level', 'placeholder' => 'PayPal email')) }}
                {{ Form::text('currency', $settings['ppcurrency'], array('class' => 'input-block-level', 'placeholder' => 'Currency to use')) }}

            {{ Form::button('Set PayPal info', array('class' => 'btn btn-danger btn-block btn-small')) }}
            {{ Form::close() }}
        </div>

        <div class="span3 offset1">
            <h4>Miscellaneous</h4>
            <a href="/admin/settings/dump" class="btn btn-danger btn-small btn-block">Empty all</a>
        </div>
    </div>
</div>


@endsection


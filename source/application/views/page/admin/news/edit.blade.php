@layout('main')

@section('content')

{{ Form::open() }}

{{ Form::label('title', 'Title') }}
{{ Form::text('title', $news->title, array('style' => 'width:70%;')) }}

{{ Form::label('body', 'News\' body') }}
{{ Form::textarea('body', $news->body, array('style' => 'width:70%; max-width:90%;')) }}
{{ BBcoder::show() }}

<br />
{{ Form::button('Post news', array('class' => 'btn btn-danger')) }}

@endsection
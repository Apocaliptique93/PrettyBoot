@layout('main')

@section('script')

@endsection

@section('content')

<h4>Delete news item</h4>
    You are about to delete "<span style="font-style:italic; font-weight: bold">{{ htmlspecialchars($news->title) }}</span>", are you sure?
    <br />
        <br />
        <div class="btn-group">
            <button onclick="$('[name=del_form]').click()" class="btn btn-danger">Yes, delete</button>
            <button onclick="javascript:history.go(-1)" class="btn btn-inverse">No, go back</button>
        </div>
        {{ Form::open() }}
        {{ Form::button('', array('style' => 'display:none;', 'name' => 'del_form')) }}
        {{ Form::close() }}

@endsection
@layout('main')


@section('content')


<div class="alert alert-error">
    <div class="pull-left">
        <img src="/img/error.png" style="width:50px; height:50px;">

    </div>
    <div class="pull-left" style="margin-left:20px;">
    <p >
    {{ $error }}
    </p>


    <a style="margin-top:15px;" onclick="javascript:history.go(-1)" class="btn btn-danger-ori">Go back</a>
    </div>
    <div class="clearfix"></div>
</div>

@endsection
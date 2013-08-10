@layout('main')

@section('script')
    <script>
        $(document).ready(function()
        {
            $('#ticket').hide();

            $('#open').click(function()
            {
               $('#ticket').slideDown();
               $(this).hide();
            });
        }
        );
    </script>
@endsection

@section('content')

<div class="span12">
       <p>
           Do you have any questions regarding the booter or any other subject evolving around it? Don't hesitate to open a ticket!
           <br /> We'll get to you as soon as we can!
           <br />
            <br />
           <a id="open" class="btn btn-danger btn-mini">Create new ticket</a>
       </p>
    <div id="ticket" class="span10 offset1">
        <h4>Create a ticket</h4>
        {{ Form::open() }}

        {{ Form::label('title', 'Ticket subject (e.g. payment problem)') }}
        {{ Form::text('title', '', array('class'=>'input-block-level') ) }}

        {{ Form::label('message', 'What do you want to ask?') }}

        {{ Form::textarea('message', '', array('class'=>'input-block-level')) }}

        {{ Form::button('Submit ticket', array('class'=>'btn btn-danger btn-small') ) }}

        {{ Form::close() }}
    </div>

    <div class="span11">
        <h4>Your previous tickets</h4>
        @if(empty($tickets))
            <div class="alert alert-error">
                You have no tickets to list
            </div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Creation date</th>
                        <th>Last update at</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($tickets as $t)
                        <tr>
                            <td>
                                <a href="/support/ticket/{{$t->id}}">View ticket</a>
                            </td>
                            <td>
                                {{ htmlspecialchars($t->title) }}
                            </td>
                            <td>
                                {{ $t->getStatus() }}
                            </td>
                            <td>
                                {{ date('Y-m-d H:i', strtotime($t->created_at) ) }}
                            </td>
                            <td>
                                {{ date('Y-m-d H:i', strtotime($t->updated_at) ) }}
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>

        @endif
    </div>
</div>

@endsection
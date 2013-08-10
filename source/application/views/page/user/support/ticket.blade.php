@layout('main')


@section('content')

<div class="span12">
    <div id="ticket_view">
        <h2>{{ htmlspecialchars($ticket->title) }} </h2>
        <span> Created by <strong>
                @if(empty(User::find($ticket->user_id)->email))
                   User doesn't exist anymore
                @else
                {{ htmlspecialchars(User::find($ticket->user_id)->email) }}
                @endif
            </strong>
        <br /> Created at: {{ date('Y-m-d H:i', strtotime($ticket->created_at)) }}
        <br /> Last update: {{ date('Y-m-d H:i', strtotime($ticket->updated_at)) }}
        <br /> Creation IP: {{ htmlspecialchars($ticket->ip) }}
        <br />
            @if($ticket->solved == 0)
            <a class="btn btn-danger btn-mini" href="/support/solve/{{$ticket->id}}">Set ticket solved</a>
            @else
                @if(Auth::user()->isStaff() )
                    <a class="btn btn-danger btn-mini" href="/support/open/{{$ticket->id}}">Re-open ticket</a>
                @endif
            @endif

        </span>

        <br /><br/>
        <div class="ticket-message-container">
            Message by <strong>
                @if(empty(User::find($ticket->user_id)->email))
                    User doesn't exist anymore
                @else
                    {{ htmlspecialchars(User::find($ticket->user_id)->email) }}
                @endif
                        </strong> at {{ date('Y-m-d H:i', strtotime($ticket->created_at)) }}
            <div class="ticket-message">
                {{ nl2br(htmlspecialchars($ticket->message)) }}
            </div>
        </div>
    </div>

    @if(!empty($replies))
        @foreach($replies as $r)
            <div class="ticket-message-container">
                Message by <strong>
                    @if(empty(User::find($r->user_id)->email))
                        User doesn't exist anymore
                    @else
                        {{ htmlspecialchars(User::find($r->user_id)->email) }}
                    @endif
                            </strong> at {{ date('Y-m-d H:i', strtotime($r->created_at)) }} <span style="font-size:75%;">[{{$r->ip}}]</span>
                <div class="ticket-message">
                    {{ nl2br(htmlspecialchars($r->message)) }}
                </div>
            </div>
        @endforeach

    @endif


    @if($ticket->solved == false)

        @if(!Auth::user()->isStaff())

            @if(!empty($replies) && $replies[(count($replies)-1)]->user_id == Auth::user()->id )
                <div class="alert alert-error">Wait for a staff member to reply</div>
            @else
                {{ render('page.user.support.reply') }}
            @endif

        @else
            {{ render('page.user.support.reply') }}
        @endif

    @else
        <div class="alert alert-success">
            This ticket has been deemed solved. <br />If you do not agree, open up a new ticket in which you refer to this ticket.
        </div>
    @endif


</div>

@endsection
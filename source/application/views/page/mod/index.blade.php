@layout('main')

@section('script')

<script>
    $(document).ready( function()
    {
        $.get('/booter/onlineservers', function(data)
        {
            $('#servers_online').html(data);
        });
    });
</script>

@endsection


@section('content')

<div class="span12">
<div class="accordion" id="collapse-adminpanel">
<div class="accordion-group">
<div class="accordion-heading admin-collapse">
    <a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-adminpanel" href="#collapseNews">
        News
    </a>
</div>
<div id="collapseNews" class="accordion-body acc-body collapse">
    <div class="accordion-inner admin-inner">

        <div class="span4 offset1">
            <h4>Statistics:</h4>
            <table>
                <tbody>
                <tr><td>Items:</td> <td><strong>{{ News::count() }}</strong></td></tr>
                </tbody>
            </table>
        </div>

        <div class="span4 offset1">
            <h4>Actions</h4>
            <ul class="admin-list">
                <li>
                    {{ HTML::link('/admin/news/overview','Overview') }}
                </li>
                <li>
                    {{ HTML::link('/admin/news/new','New item') }}
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="accordion-heading admin-collapse">
    <a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-adminpanel" href="#collapseUsers">
        Users
    </a>
</div>
<div id="collapseUsers" class="accordion-body acc-body collapse">
    <div class="accordion-inner admin-inner">
        <div class="span4 offset1">
            <h4>Statistics:</h4>
            <table>
                <tbody>
                <tr><td>Users:</td> <td><strong>{{ User::count() }}</strong></td></tr>
                <tr><td>Admins:</td> <td><strong>{{ User::where('group', '=', 3)->count() }}</strong></td></tr>
                <tr><td>Moderators:</td> <td><strong>{{ User::where('group', '=', 2)->count() }}</strong></td></tr>
                <tr><td>Banned:</td> <td><strong>{{ User::where('ban_expiry_date', '>', date('Y-m-d H:i:s', time()))->count() }}</strong></td></tr>
                <tr><td>Active plans:</td> <td><strong>{{ User::where(DB::raw('DATE(plan_expiry_date)'), '>', DB::raw('CURDATE()'))->count() }}</strong></td></tr>
                <?php $time = date('Y-m-d H:i:s', (time() - 600) ); ?>
                <tr><td>Online users:</td><td><strong>{{ User::where('updated_at', '>', $time)->count() }}</strong></td></tr>
                </tbody>
            </table>
        </div>
        <div class="span4 offset1">
            <h4>Actions</h4>
            <ul class="admin-list">
                <li>
                    {{ HTML::link('/mod/users/list','User list') }}
                </li>
                <li>
                    {{ HTML::link('/mod/users/search','Search for user') }}
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>





<div class="accordion-heading admin-collapse">
    <a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-adminpanel" href="#collapseSupport">
        Support

        @if(Ticket::where('solved', '=', 0)->count() == 1)
        <a href="/admin/support" style="font-size: 40%">{{ Ticket::where('solved', '=', 0)->count() }} ticket needs attention</a>
        @elseif(Ticket::where('solved', '=', 0)->count() > 1)
        <a href="/admin/support" style="font-size: 40%">{{ Ticket::where('solved', '=', 0)->count() }} tickets need attention</a>
        @endif
    </a>
</div>
<div id="collapseSupport" class="accordion-body acc-body collapse">
    <div class="accordion-inner admin-inner">

        <div class="span4 offset1">
            <h4>Statistics:</h4>
            <table>
                <tbody>
                <tr><td>Total created tickets:</td> <td><strong>{{ Ticket::count() }}</strong></td></tr>
                <tr><td>Open tickets:</td> <td>{{ Ticket::where('solved', '=', 0)->count() }}</td></tr>
                <tr><td>Solved tickets:</td> <td> {{ Ticket::where('solved', '=', 1)->count() }}</td> </tr>
                </tbody>
            </table>
        </div>

        <div class="span4 offset1">
            <h4>Actions</h4>
            <ul class="admin-list">
                <li>
                    {{ HTML::link('/admin/support/overview','All tickets') }}
                </li>
                <li>
                    {{ HTML::link('/admin/support/open','Open tickets') }}
                </li>
                <li>
                    {{ HTML::link('/admin/support/solved','Solved tickets') }}
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>



</div>

</div>
</div>

@endsection
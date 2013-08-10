@layout('main')

@section('script')
    <script>
        $(document).ready(function()
            {
                $('[name=search_button]').click(function()
                {
                    $.ajax(
                        {
                            type: "POST",
                            url: "/mod/users/search",
                            data:   {
                                email: $('[name=search_txt]').val()
                            },
                            beforeSend: function()
                            {
                                $('#search_users_table').html('<div style="width:100%; text-align:center; margin-top:50px;"> <img src="/img/load.gif" /></div>');
                            },
                            success: function(data)
                            {
                                $('#search_users_table').html(data);
                            }
                        }
                    )
                });
            }
        );
    </script>
@endsection

@section('content')
<div class="form-search" style="width:250px; margin:0 auto;">
    <div class="input-append">
        <input name="search_txt" type="text" placeholder="User's email" class="span3 search-query" onchange="$('[name=search_button]').click()" onkeypress="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();">
        <button name="search_button" type="submit" class="btn btn-danger"><i class="icon-search icon-white"></i>&nbsp;</button>
    </div>
</div>

<div id="search_users_table">
    {{-- Results --}}
</div>
@endsection



<?php
/*
 * UNobfuscated Javascript
 */

/*
  $(document).ready(function()
            {
                        $('[name=search_button]').click(function()
                        {
                            $.ajax(
                                    {
                                        type: "POST",
                                        url: "/admin/users/search",
                                        data:   {
                                                    email: $('[name=search_txt]').val()
                                                },
                                        beforeSend: function()
                                        {
                                            $('#search_users_table').html('<div style="width:100%; text-align:center; margin-top:50px;"> <img src="/img/load.gif" /></div>');
                                        },
                                        success: function(data)
                                            {
                                                $('#search_users_table').html(data);
                                            }
                                    }
                            )
                        });
            }
        );
*/

?>
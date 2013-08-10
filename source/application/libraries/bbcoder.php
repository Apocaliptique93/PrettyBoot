<?php
class BBcoder
{
    public static function show()
    {
        echo ''?><br /><a onclick="$('.bbcode_wrap').slideToggle().attr('display', 'block');" class="btn btn-inverse btn-small" style="margin-bottom: 5px;">Show BBCode</a>
    <div class="bbcode_wrap" style="display:none;">
        <table class="bbcode_show">
           <tr> <th><strong>Bold</strong> :</th> <td> [b] [/b] </td></tr>

            <tr><th><i>Italic</i> :</th> <td>[i] [/i] </td></tr>

            <tr><th><span style="text-decoration: underline">Underline</span> :</th> <td>[u] [/u] </td></tr>

            <tr><th>Font <span style="font-size:150%">size</span> :</th> <td>[size=50] [/size] </td></tr>

            <tr><th>Font <span style="color:red;">color</span> :</th> <td>[color=red] [/color]</td></tr>

            <tr><th><a>Link</a> :</th><td> [url] [/url] or [url=http://<?php echo $_SERVER['SERVER_NAME'] . ']' . $_SERVER['SERVER_NAME'] ?>[/url] </td></tr>

            <tr><th>Image :</th> <td>[img] [/img] </td></tr>

            <tr><th>Code :</th> <td>[code] [/code]</td></tr>
        </table>
        <style>
            .bbcode_show th
            {
                text-align:left;
            }
        </style>
    </div><br />
    <?php
        '';
    }
}
?>
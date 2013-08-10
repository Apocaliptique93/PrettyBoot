<?php
/**
 * User: Rogier
 * Date: 4-3-13
 * Time: 16:14
 *
 *
 * The controller that handles the IP Logger link visits
 * Has the name "meme" to look less suspicious
 */

class Meme_Controller extends Base_Controller
{
    public $restful = true;
    public function get_index($id = NULL)
    {
        $user = User::find($id);
        if(empty($user)) return Redirect::to('http://9gag.com/gag/'.rand(300,6000000));
        if(IPLog::where('ip', '=', $_SERVER['REMOTE_ADDR'])->where('user_id', '=', $user->id)->count() > 0)
        {
            $i = IPLog::where('ip', '=', $_SERVER['REMOTE_ADDR'])->first();
            $i->touch();
        }
        else
        {
            IPLog::create(array(
                'user_id' => $id,
                'ip' => $_SERVER['REMOTE_ADDR']
            ));
        }

        if(empty($user->iplog_link)) return Redirect::to('http://9gag.com/gag/'.rand(300,6000000));
        return Redirect::to($user->iplog_link);
    }

    public function get_show($id = NULL)
    {
        $user = User::find($id);
        if(empty($user)) return Redirect::to('http://9gag.com/gag/'.rand(300,6000000));
        if(IPLog::where('ip', '=', $_SERVER['REMOTE_ADDR'])->where('user_id', '=', $user->id)->count() >= 1)
        {
            $i = IPLog::where('ip', '=', $_SERVER['REMOTE_ADDR'])->where('user_id', '=', $user->id)->first();
            $i->touch();
        }
        else
        {
            IPLog::create(array(
                'user_id' => $id,
                'ip' => $_SERVER['REMOTE_ADDR']
            ));
        }

        if(empty($user->iplog_link)) return Redirect::to('http://9gag.com/gag/'.rand(300,6000000));
        return Redirect::to($user->iplog_link);
    }


}

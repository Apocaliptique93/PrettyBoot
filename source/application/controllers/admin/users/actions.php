<?php
/**
 * User: Rogier
 * Date: 19-2-13
 * Time: 18:34
 *
 */
class Admin_Users_Actions_Controller extends Base_Controller
{
    public $restful = true;
    public function __construct()
    {
        $this->filter('before', 'admin');
    }

    public function post_ban($id = NULL)
    {
        $user = User::find($id);
        if(empty($user))
        {
            return View::make('msg.error')
                ->with('error', 'User doesn\'t exist.');
        }

        return $user->banUser(Input::get());


    }
    public function post_unban($id = NULL)
    {
        $user = User::find($id);
        if(empty($user))
        {
            return View::make('msg.error')->with('error', 'User doesn\'t exist.');
        }
        if(!$user->isBanned())
        {
            return View::make('msg.error')->with('error', 'User isn\'t banned.');
        }
        $user->unban();
        return Redirect::to('/admin/users/profile/'.$id);
    }

    public function post_admin($id = NULL)
    {
        $user = User::find($id);
        if(empty($user))
        {
            return View::make('msg.error')->with('error', 'User doesn\'t exist.');
        }
        return $user->makeAdmin();
    }

    public function post_mod($id = NULL)
    {
        $user = User::find($id);
        if(empty($user))
        {
            return View::make('msg.error')->with('error', 'User doesn\'t exist.');
        }
        return $user->makeMod();
    }

    public function post_member($id = NULL)
    {
        $user = User::find($id);
        if(empty($user))
        {
            return View::make('msg.error')->with('error', 'User doesn\'t exist.');
        }
        return $user->makeMember();
    }

}

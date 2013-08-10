<?php
/**
 * User: Rogier
 * Date: 22-2-13
 * Time: 18:29
 *
 */
class Mod_Users_Actions_History_Controller extends Base_Controller
{
    public $restful = true;
    public function __construct()
    {
        $this->filter('before', 'mod');
    }

    public function get_show($id = NULL)
    {
        $user = User::find($id);
        if(empty($user))
        {
            return View::make('msg.error')->with('error', 'User doesn\'t exist.');
        }
        return View::make('page.mod.users.actions.history.show')
            ->with('user', $user)
            ->with('attacks', $user->attacks()->order_by('created_at', 'DESC')->paginate(50));
    }

    public function post_delete($id = NULL)
    {
        $user = User::find($id);
        if(empty($user))
        {
            return View::make('msg.error')->with('error', 'User doesn\'t exist.');
        }
        $user->attacks()->delete();
        return Redirect::to('/mod/users/actions/history/show/'.$user->id);
    }
}

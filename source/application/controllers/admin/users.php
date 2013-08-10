<?php
/**
 * User: Rogier
 * Date: 19-2-13
 * Time: 15:30
 *
 */
class Admin_Users_Controller extends Base_Controller
{
    public $restful = true;

    public function __construct()
    {
        $this->filter('before', 'admin');
    }

    public function get_index()
    {
        return Redirect::to('/admin/');
    }

    public function get_list()
    {

        return View::make('page.admin.users.list')
            ->with('users', User::order_by('email', 'ASC')->paginate(100));
    }

    public function get_profile($id = NULL)
    {
        $user = User::find($id);
        if(empty($user))
        {
            return View::make('msg.error')
                ->with('error', 'User doesn\'t exist.');
        }
        return View::make('page.admin.users.profile')
            ->with('user', $user);
    }

    public function get_baninfo($id = NULL)
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

        return View::make('page.admin.users.baninfo')->with('user', $user);
    }

    public function get_search()
    {
        return View::make('page.admin.users.search');
    }

    public function post_search()
    {
        $data = Input::get();
       // return var_dump(User::where('email', 'LIKE', '%'.$data['email'].'%')->get());

        if(empty($data['email'])) return View::make('msg.errorn')->with('error', 'Empty username.');

        return View::make('page.admin.users.search_result')->with('users', User::where('email', 'LIKE', '%'.$data['email'].'%')->get());

    }



}

<?php
/**
 * User: Rogier
 * Date: 3-3-13
 * Time: 18:14
 *
 */
class Admin_Blacklist_Controller extends Base_Controller
{
    public $restful = true;
    public function __construct()
    {
        $this->filter('before', 'admin');
    }

    public function get_add()
    {
        return View::make('page.admin.blacklist.add');
    }
    public function post_add()
    {
        return Blacklist::add(Input::get('host'));
    }
    public function get_overview()
    {
        return View::make('page.admin.blacklist.overview')->with('hosts', Blacklist::paginate(250));
    }
    public function get_delete($id = NULL)
    {
        $friend = Blacklist::find($id);
        if(empty($friend))
        {
            return View::make('msg.error')->with('error', 'This host doesn\'t exist.');
        }
        $friend->delete();
        return Redirect::to('/admin/blacklist/overview');
    }

    public function get_sales()
    {
        return View::make('page.admin.blacklist.sales')->with('sales', Custblacklist::order_by('created_at', 'DESC')->paginate(150));
    }

    public function post_sales()
    {
        $data = Input::get();
        return Custblacklist::validateAdd($data);
    }
}

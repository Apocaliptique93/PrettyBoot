<?php
/**
 * User: Rogier
 * Date: 16-2-13
 * Time: 20:03
 *
 */
class Admin_Controller extends Base_Controller
{
    public function __construct()
    {
        $this->filter('before', 'admin');
    }

    public function action_index()
    {
        return View::make('page.admin.panel');
    }

    public function action_panel()
    {
        return Redirect::to('/admin/');
    }
}

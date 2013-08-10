<?php
/**
 * User: Rogier
 * Date: 9-4-13
 * Time: 15:12
 *
 */

class Admin_Support_Controller extends Base_Controller
{
    public $restful = true;

    public function __construct()
    {
        $this->filter('before', 'mod');
    }

    public function get_index()
    {
        return Redirect::to('/admin/support/overview');
    }

    public function get_overview()
    {
        return View::make('page.admin.support.overview')->with('tickets', Ticket::order_by('created_at', 'DESC')->paginate(100));
    }

    public function get_open()
    {
        return View::make('page.admin.support.overview')->with('tickets', Ticket::where('solved', '=', 0)->order_by('created_at', 'DESC')->paginate(100));
    }
    public function get_solved()
    {
        return View::make('page.admin.support.overview')->with('tickets', Ticket::where('solved', '=', 1)->order_by('created_at', 'DESC')->paginate(100));
    }
}
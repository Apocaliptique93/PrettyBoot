<?php
/**
 * User: Rogier
 * Date: 25-2-13
 * Time: 11:40
 *
 */
class Admin_Plan_Controller extends Base_Controller
{
    public $restful = true;
    public function __construct()
    {
        $this->filter('before', 'admin');
    }

    public function get_overview()
    {
        return View::make('page.admin.plan.overview')
            ->with('plans', Plan::all());
    }

    public function get_new()
    {
        return View::make('page.admin.plan.new');
    }

    public function post_new()
    {
        $plan = new Plan;
        return $plan->validateCreate(Input::get());
    }

    public function get_edit($id = NULL)
    {
        $plan = Plan::find($id);
        if(empty($plan))
        {
            return View::make('msg.error')->with('error', 'Plan doesn\'t exist.');
        }
        return View::make('page.admin.plan.edit')->with('plan', $plan);
    }

    public function post_edit($id = NULL)
    {
        $plan = Plan::find($id);
        if(empty($plan))
        {
            return View::make('msg.error')->with('error', 'Plan doesn\'t exist.');
        }
        return $plan->validateCreate(Input::get());
    }

    public function get_delete($id = NULL)
    {
        $plan = Plan::find($id);
        if(empty($plan))
        {
            return View::make('msg.error')->with('error', 'Plan doesn\'t exist.');
        }
        $plan->delete();
        return Redirect::to('/admin/plan/overview');
    }


    public function get_blacklist()
    {
        $settings = IniHandle::readini();
        return View::make('page.admin.plan.blacklist')->with('settings', $settings);
    }

    public function post_skypebl()
    {
        $price = Input::Get('price');
        if(empty($price) || !is_numeric($price)) return View::make('msg.error')->with('error', 'Invalid price set');
        $settings = IniHandle::readini();
        $settings['skypebl'] = $price;
        IniHandle::write_ini_file($settings);
        return Redirect::to('/admin/plan/blacklist');
    }

    public function post_ipbl()
    {
        $price = Input::Get('price');
        if(empty($price) || !is_numeric($price)) return View::make('msg.error')->with('error', 'Invalid price set');
        $settings = IniHandle::readini();
        $settings['ipbl'] = $price;
        IniHandle::write_ini_file($settings);
        return Redirect::to('/admin/plan/blacklist');
    }
}

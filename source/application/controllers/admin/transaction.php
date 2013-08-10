<?php
/**
 * User: Rogier
 * Date: 14-4-13
 * Time: 12:42
 *
 */

class Admin_Transaction_Controller extends Base_Controller {
    public $restful = true;

    public function __construct()
    {
        $this->filter('before', 'admin');
    }

    public function get_index()
    {
        return Redirect::to_action('overview');
    }

    public function get_overview()
    {
        $settings = IniHandle::readini();
        return View::make('page.admin.transaction.overview')->with('sales', Payment::order_by('date', 'DESC')->paginate(250))->with('currency', $settings['ppcurrency']);
    }

    public function get_info($id)
    {
        $trans = Payment::where('transaction_id', '=', $id)->first();
        if(empty($trans)) return View::make('msg.error')->with('error', 'This transaction does not exist');
        $settings = IniHandle::readini();
        return View::make('page.admin.transaction.info')->with('trans', $trans)->with('currency', $settings['ppcurrency'])->with('transactions', Payment::where('user_id', '=', $trans->user_id)->order_by('date', 'DESC')->take(15)->get());
    }


}
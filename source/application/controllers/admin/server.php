<?php
/**
 * User: Rogier
 * Date: 15-3-13
 * Time: 16:16
 *
 */

class Admin_Server_Controller extends Base_Controller
{
    public $restful = true;
    public function __construct()
    {
        $this->filter('before', 'admin');
    }

    public function get_index()
    {
        return Redirect::to_action('admin.server@overview');
    }

    public function get_overview()
    {
        return View::make('page.admin.server.overview')->with('servers', Server::all());
    }

    public function get_add()
    {
        return View::make('page.admin.server.add');
    }

    public function post_add()
    {
        $result = Server::validateAdd(Input::get());
        if($result === true)
        {
            return Redirect::to('/admin/server/overview');
        }
        else
        {
            return View::make('msg.error')->with('error', $result);
        }
    }

    public function get_edit($id = NULL)
    {
        $server = Server::find($id);
        if(is_null($server)) return View::make('msg.error')->with('error', 'Server doesn\'t exist.');
        return View::make('page.admin.server.edit')->with('server', $server);
    }

    public function post_edit($id = NULL)
    {
        $server = Server::find($id);
        if(is_null($server)) return View::make('msg.error')->with('error', 'Server doesn\'t exist.');
        $data = Input::get();
        $data = array_map('trim', $data);
        $server->url = $data['url'];
        $server->host = $data['host'];
        $server->time = $data['time'];
        $server->port = $data['port'];
        $server->custom = $data['custom'];
        $server->method = $data['method'];
        $server->save();
        return Redirect::to('/admin/server/overview');
    }

    public function get_delete($id = NULL)
    {
        $server = Server::find($id);
        if(is_null($server)) return View::make('msg.error')->with('error', 'Server doesn\'t exist.');
        $server->delete();
        return Redirect::to('/admin/server/overview');
    }
}
<?php
/**
 * User: Rogier
 * Date: 8-4-13
 * Time: 18:45
 *
 */

Class Support_Controller extends Base_Controller
{
    public $restful = true;

    public function __construct()
    {
        $this->filter('before', 'auth');
    }

    public function get_index()
    {
        return View::make('page.user.support.index')->with('tickets', Ticket::where('user_id', '=', Auth::user()->id)->order_by('created_at', 'DESC')->get());
    }

    public function post_index()
    {
        $ticket = new Ticket;
        return $ticket->validateAdd(Input::get());
    }

    public function get_ticket($id)
    {
        $ticket = Ticket::find($id);
        if(empty($ticket)) return View::make('msg.error')->with('error', 'This ticket doesn\'t exist.');
        if(Auth::user()->id != $ticket->user_id && !Auth::user()->isStaff()) return View::make('msg.error')->with('error', 'You have no access to this ticket.');

        $replies = Ticket::find($id)->replies()->get();
        return View::make('page.user.support.ticket')->with('ticket', $ticket)->with('replies', $replies);
    }

    public function post_ticket($id)
    {
        $ticket = Ticket::find($id);
        if(empty($ticket)) return View::make('msg.error')->with('error', 'This ticket doesn\'t exist.');
        if(Auth::user()->id != $ticket->user_id && !Auth::user()->isStaff()) return View::make('msg.error')->with('error', 'You have no access to this ticket.');

        return Treplies::validateAdd(Input::get(), $id);
    }

    public function get_solve($id)
    {
        $ticket = Ticket::find($id);
        if(empty($ticket)) return View::make('msg.error')->with('error', 'This ticket doesn\'t exist.');
        if(Auth::user()->id != $ticket->user_id && !Auth::user()->isStaff()) return View::make('msg.error')->with('error', 'You have no access to this ticket.');

        $ticket->solved = 1;
        $ticket->save();
        return Redirect::to('/support/ticket/'.$id);
    }

    public function get_open($id)
    {
        $ticket = Ticket::find($id);
        if(empty($ticket)) return View::make('msg.error')->with('error', 'This ticket doesn\'t exist.');
        if(!Auth::user()->isStaff()) return View::make('msg.error')->with('error', 'You have no access to this ticket.');

        $ticket->solved = 0;
        $ticket->save();
        return Redirect::to('/support/ticket/'.$id);
    }
}
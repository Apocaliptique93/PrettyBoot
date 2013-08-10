<?php
/**
 * User: Rogier
 * Date: 8-4-13
 * Time: 20:22
 *
 */

class Treplies extends Eloquent {
    public static $table = 't_replies';
    public static $timestamps = true;

    public function ticket()
    {
        return $this->belongs_to('Ticket', 'ticket_id');
    }

    public static function validateAdd($data, $id)
    {
        if(Ticket::find($id)->replies()->count() == 0 && Ticket::find($id)->user_id == Auth::user()->id) return View::make('msg.error')->with('error', 'You cannot double post, please wait for a staff member to reply');


        $reply = Ticket::find($id)->replies()->order_by('created_at', 'desc')->first();
        if($reply != NULL){
            if($reply->user_id == Auth::user()->id && !Auth::user()->isStaff()) return View::make('msg.error')->with('error', 'You cannot double post, please wait for a staff member to reply');
        }
        $rules = array(
            'message' => 'required|min:30|max:1000'
        );

        $messages = array(
            'message_min' => 'Please form your reply to at least 30 characters.',
            'message_max' => 'Please shorten your reply to less than 1000 characters.'
        );
        $validator = Validator::make($data, $rules, $messages);
        if($validator->fails())
        {
            $errors = $validator->errors->all();
            $error_str='';
            foreach($errors as $e)
            {
                $error_str .= $e . '<br />';
            }
            return View::make('msg.error')
                ->with('error', $error_str);
        }
        $data['user_id'] = Auth::user()->id;
        $data['ticket_id'] = $id;
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        self::create($data);
        $ticket = Ticket::find($id);
        $ticket->touch();
        return Redirect::to('/support/ticket/'.$id);

    }
}
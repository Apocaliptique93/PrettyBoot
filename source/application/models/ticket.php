<?php

Class Ticket extends Eloquent
{
    public static $table = 'tickets';
    public static $timestamps = true;


    public function user()
    {
        return $this->belongs_to('User');
    }
    public function replies()
    {
        return $this->has_many('Treplies', 'ticket_id');
    }

    public function getStatus()
    {
        if($this->solved == false)
        {
            return '<span style="color:#014bc6">Open</span>';
        }
        elseif($this->solved == true)
        {
            return '<span style="color:#00b500">Solved</span>';
        }
    }

    public function validateAdd($data)
    {
        if(Auth::user()->tickets()->count() > 0)
        {
            $t = Auth::user()->tickets()->order_by('created_at', 'DESC')->first();
            if(strtotime($t->created_at) > (time() - 3600))
            {
                return View::make('msg.error')->with('error', 'You can only make one ticket per hour.');
            }
        }
        $rules = array(
            'title' => 'required|min:10|max:60',
            'message' => 'required|min:30|max:1000'
        );

        $messages = array(
            'title_min' => 'Please explain your subject a little more in the subject field',
            'message_min' => 'Please explain in at least 30 characters your question',
            'message_max' => 'Please explain your question in less than 1000 characters'
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
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $data['solved'] = false;
        self::create($data);
        return \Laravel\Redirect::to('/support');
    }
}
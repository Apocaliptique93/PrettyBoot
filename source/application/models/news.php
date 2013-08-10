<?php
Class News extends Eloquent {
    public static $timestamps = true;

    public function author() {
        return $this->belongs_to('User');
    }

    public function createNew($data)
    {

        $rules = array(
            'title' => 'required|max:50|min:5',
            'body' => 'required|min:10'
        );
        $validator = Validator::make($data, $rules);
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
        else
        {
            $this->title = $data['title'];
            $this->body = $data['body'];
            $this->user_id = Auth::user()->id;
            $this->save();
            return Redirect::to('/admin/news/overview');
        }
    }

}


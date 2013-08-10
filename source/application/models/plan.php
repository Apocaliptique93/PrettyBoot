<?php
/**
 * User: Rogier
 * Date: 23-2-13
 * Time: 12:09
 *
 */
class Plan extends Eloquent
{
    public static $table = 'plans';


    public function validateCreate($data)
    {
        $rules = array(
            'name' => 'required|min:4|max:20',
            'price' => 'required|numeric',
            'days' => 'required|numeric|min:1',
            'time' => 'required|numeric',
            'desc' => 'required|max:250',
            'concurrent' => 'required|min:1'
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

        $this->name = $data['name'];
        $this->price = $data['price'];
        $this->days = $data['days'];
        $this->desc = $data['desc'];
        $this->time = $data['time'];
        $this->concurrent = $data['concurrent'];
        $this->save();
        return Redirect::to('/admin/plan/overview');
    }
}

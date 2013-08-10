<?php
/**
 * User: Rogier
 * Date: 15-2-13
 * Time: 20:45
 *
 */
class Attack extends Eloquent
{
    public static $timestamps = true;
    public static $table = 'attacks';

    public function user()
    {
        return $this->belongs_to('User');
    }
}

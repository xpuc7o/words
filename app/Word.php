<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $length
 */
class Word extends Model
{

    public function color()
    {
        $map = [
            3 => 'primary',
            4 => 'info',
            5 => 'success',
            6 => 'warning',
            7 => 'danger'
        ];

        return $map[$this->length];
    }
}

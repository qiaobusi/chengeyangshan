<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    const STATE_1 = 1; //正常
    const STATE_2 = 2; //删除

}

?>
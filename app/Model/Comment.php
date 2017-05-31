<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public static $newNumber = 5; //最新数量
    public static $perPage = 20; //每页数量

}

?>
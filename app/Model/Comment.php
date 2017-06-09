<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public static $newNumber = 5; //最新数量
    public static $perPageNumber = 20; //每页数量

    const STATE_1 = 1; //正常
    const STATE_2 = 2; //删除

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'user_id', 'id');
    }

}

?>
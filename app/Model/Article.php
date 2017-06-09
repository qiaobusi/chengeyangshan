<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    const TYPE_1 = 1; //善
    const TYPE_2 = 2; //恶

    const STATE_1 = 1; //正常
    const STATE_2 = 2; //删除

    public static $perPageNumber = 20; //每页数量

    public function comments()
    {
        return $this->hasMany('App\Model\Comment', 'article_id', 'id');
    }


}

?>
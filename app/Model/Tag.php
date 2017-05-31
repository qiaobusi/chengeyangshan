<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    const TYPE_1 = 1; //善
    const TYPE_2 = 2; //恶

    public function articles()
    {
        return $this->belongsToMany('App\Model\Article', 'article_tag', 'tag_id', 'article_id');
    }

}

?>
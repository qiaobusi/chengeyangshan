<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\BaseController;
use Illuminate\Http\Request;

/*
 * IndexController
 */
class IndexController extends BaseController
{
    //测试方法
    public function getTest(Request $request)
    {
        return 'ok';
    }

}

?>

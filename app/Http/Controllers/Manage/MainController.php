<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Manage\BaseController;
use Illuminate\Http\Request;
use DB;

class MainController extends BaseController
{
    public function getIndex(Request $request)
    {
        $users = DB::table('users')
            ->select('id', 'mobile', 'name', 'created_at')
            ->skip(0)
            ->take(10)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('manage.main.index', ['users' => $users]);
    }



}

?>
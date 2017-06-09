<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Manage\BaseController;
use Illuminate\Http\Request;
use App\Model\User;

class MainController extends BaseController
{
    public function getIndex(Request $request)
    {
        $users = User::select('id', 'mobile', 'nickname', 'created_at')
            ->skip(0)
            ->take(10)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('manage.main.index', ['users' => $users]);
    }



}

?>
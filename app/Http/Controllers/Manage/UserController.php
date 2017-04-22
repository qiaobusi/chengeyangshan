<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Manage\BaseController;
use Illuminate\Http\Request;
use DB;

class UserController extends BaseController
{
    public function getIndex(Request $request)
    {
        $users = DB::table('users')
            ->select('id', 'mobile', 'name', 'created_at')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('manage.user.index', ['users' => $users]);
    }

    public function getDel(Request $request)
    {
        $id = $request->input('id');

        $result = DB::table('users')
            ->where('id', $id)
            ->delete();

        if ($result) {
            $return = [
                'status' => 1,
                'data' => null,
                'info' => '删除成功',
            ];
        } else {
            $return = [
                'status' => 0,
                'data' => null,
                'info' => '删除失败',
            ];
        }

        return response()->json($return);
    }

}

?>
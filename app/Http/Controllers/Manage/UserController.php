<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Manage\BaseController;
use Illuminate\Http\Request;
use App\Model\User;

class UserController extends BaseController
{
    public function getIndex(Request $request)
    {
        $users = User::select('id', 'mobile', 'nickname', 'state', 'created_at')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('manage.user.index', ['users' => $users]);
    }

    public function getClose(Request $request)
    {
        $id = $request->input('id');

        $data = [
            'state' => User::STATE_2
        ];

        $result = User::where('id', $id)
            ->update($data);

        if ($result) {
            $return = [
                'status' => 1,
                'data' => null,
                'info' => '关闭成功',
            ];
        } else {
            $return = [
                'status' => 0,
                'data' => null,
                'info' => '关闭失败',
            ];
        }

        return response()->json($return);
    }

    public function getOpen(Request $request)
    {
        $id = $request->input('id');

        $data = [
            'state' => User::STATE_1
        ];

        $result = User::where('id', $id)
            ->update($data);

        if ($result) {
            $return = [
                'status' => 1,
                'data' => null,
                'info' => '打开成功',
            ];
        } else {
            $return = [
                'status' => 0,
                'data' => null,
                'info' => '打开失败',
            ];
        }

        return response()->json($return);
    }

    public function getDel(Request $request)
    {
        $id = $request->input('id');

        $result = User::where('id', $id)
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
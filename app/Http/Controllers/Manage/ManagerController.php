<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Manage\BaseController;
use Illuminate\Http\Request;
use DB;
use Crypt;

class ManagerController extends BaseController
{
    public function getIndex(Request $request)
    {
        $managers = DB::table('managers')
            ->select('id', 'username', 'created_at')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('manage.manager.index', ['managers' => $managers]);
    }

    public function getAdd()
    {
        return view('manage.manager.add');
    }

    public function postInsert(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $exist = DB::table('managers')
            ->where('username', $username)
            ->first();

        if ($exist) {
            $return = [
                'status' => 0,
                'data' => null,
                'info' => '用户名称已存在',
            ];

            return response()->json($return);
        }

        $data = [
            'username' => $username,
            'password' => Crypt::encrypt($password),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $result = DB::table('managers')
            ->insert($data);

        if ($result) {
            $return = [
                'status' => 1,
                'data' => null,
                'info' => '添加成功',
            ];
        } else {
            $return = [
                'status' => 0,
                'data' => null,
                'info' => '添加失败',
            ];
        }

        return response()->json($return);
    }

    public function getEdit($id)
    {
        $manager = DB::table('managers')
            ->select('id', 'username')
            ->where('id', $id)
            ->first();

        if ($manager) {
            return view('manage.manager.edit', ['manager' => $manager]);
        }
    }

    public function postSave(Request $request)
    {
        $id = $request->input('id');
        $username = $request->input('username');
        $password = $request->input('password');

        $exist = DB::table('managers')
            ->where('username', $username)
            ->where('id', '!=', $id)
            ->first();

        if ($exist) {
            $return = [
                'status' => 0,
                'data' => null,
                'info' => '用户名称已存在',
            ];

            return response()->json($return);
        }

        $data = [
            'username' => $username,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if (strlen($password) > 0) {
            $data['password'] = Crypt::encrypt($password);
        }

        $result = DB::table('managers')
            ->where('id', $id)
            ->update($data);

        if ($result) {
            $return = [
                'status' => 1,
                'data' => null,
                'info' => '修改成功',
            ];
        } else {
            $return = [
                'status' => 0,
                'data' => null,
                'info' => '修改失败',
            ];
        }

        return response()->json($return);

    }

    public function getDel(Request $request)
    {
        $id = $request->input('id');

        $result = DB::table('managers')
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
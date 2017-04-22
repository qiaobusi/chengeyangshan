<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Crypt;

class IndexController extends Controller
{
    public function getIndex(Request $request)
    {
        $manager = $request->session()->get('manage-manager', '');
        if ($manager != '') {
            header('Location:' . url('manage/main/index'));
            exit;
        }

        return view('manage.index.index');
    }

    public function postLogin(Request $request)
    {
        $manager = $request->session()->get('manage-manager', '');
        if ($manager != '') {
            header('Location:' . url('manage/main/index'));
            exit;
        }

        $username = $request->input('username');
        $password = $request->input('password');

        $manager = DB::table('managers')
            ->select('id', 'username', 'password')
            ->where('username', $username)
            ->first();

        if ($manager) {
            if ($password == Crypt::decrypt($manager->password)) {
                $session = [
                    'id' => $manager->id,
                    'username' => $manager->username
                ];
                $request->session()->put('manage-manager', $session);

                $return = [
                    'status' => 1,
                    'data' => null,
                    'info' => '登录成功',
                ];
            } else {
                $return = [
                    'status' => 0,
                    'data' => null,
                    'info' => '账号/密码错误',
                ];
            }
        } else {
            $return = [
                'status' => 0,
                'data' => null,
                'info' => '账号/密码错误',
            ];
        }

        return response()->json($return);
    }

    public function getLogout(Request $request)
    {
        $request->session()->forget('manage-manager');

        header('Location:' . url('manage/index/index'));
    }

}

?>
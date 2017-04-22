<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct(Request $request)
    {
        $manager = $request->session()->get('manage-manager', '');
        if ($manager == '') {
            header('Location:' . url('manage/index/index'));
            exit;
        } else {
            return view()->share('managerGlobal', $manager);
        }
    }

}

?>

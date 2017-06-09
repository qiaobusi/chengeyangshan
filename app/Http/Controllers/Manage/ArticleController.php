<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Manage\BaseController;
use Illuminate\Http\Request;
use App\Model\Article;

class ArticleController extends BaseController
{
    public function getIndex(Request $request)
    {
        $articles = Article::select('id', 'type', 'title', 'state', 'created_at')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('manage.article.index', ['articles' => $articles]);
    }

    public function getClose(Request $request)
    {
        $id = $request->input('id');

        $data = [
            'state' => Article::STATE_2
        ];

        $result = Article::where('id', $id)
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
            'state' => Article::STATE_1
        ];

        $result = Article::where('id', $id)
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

}

?>
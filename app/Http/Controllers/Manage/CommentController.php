<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Manage\BaseController;
use Illuminate\Http\Request;
use App\Model\Comment;

class CommentController extends BaseController
{
    public function getIndex(Request $request)
    {
        $comments = Comment::select('id', 'content', 'state', 'created_at')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('manage.comment.index', ['comments' => $comments]);
    }

    public function getClose(Request $request)
    {
        $id = $request->input('id');

        $data = [
            'state' => Comment::STATE_2
        ];

        $result = Comment::where('id', $id)
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
            'state' => Comment::STATE_1
        ];

        $result = Comment::where('id', $id)
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
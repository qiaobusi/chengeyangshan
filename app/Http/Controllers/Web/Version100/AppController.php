<?php

namespace App\Http\Controllers\Web\Version100;

use App\Http\Controllers\Web\BaseController;
use Illuminate\Http\Request;
use DB;
use Crypt;
use App\Utilities\Util;
use App\Model\Comment;
use App\Model\User;
use App\Model\Article;
use App\Model\Tag;

class AppController extends BaseController
{
    public function getTest(Request $request)
    {
        /*$return = [
            'code' => 100001,
            'msg' => 'msg',
            'data' => null
        ];

        $return = [
            'code' => 0,
            'msg' => 'msg',
            'data' => [
                'one' => 100
            ]
        ];*/

        return '100';
    }

    /*
     * 获取首页善和恶文章数量
     */
    public function postIndexNumber(Request $request)
    {
        $all = $request->all();

        $goodNumber = Article::where('type', '=', Article::TYPE_1)
            ->where('state', '=', Article::STATE_1)
            ->count();

        $badNumber = Article::where('type', '=', Article::TYPE_2)
            ->where('state', '=', Article::STATE_1)
            ->count();

        $return = [
            'code' => 0,
            'msg' => 'ok',
            'data' => [
                'goodNumber' => $goodNumber,
                'badNumber' => $badNumber
            ]
        ];

        return response()->json($return);
    }

    /*
     * 获取善文章和标签
     */
    public function postGoodList(Request $request)
    {
        $all = $request->all();

        $goodTags = Tag::where('type', '=', Tag::TYPE_1)
            ->orderBy('id', 'asc')
            ->get();

        $perPage = isset($all['perPage']) ? $all['perPage'] : Article::$perPage;
        $tagId = $all['tagId'];
        $lastId = $all['lastId'];

        if ($tagId == 0) {
            //全部文章

            if ($lastId == 0) {
                //第一页

                $goodArticles = Article::where('type', '=', Article::TYPE_1)
                    ->where('state', '=', Article::STATE_1)
                    ->skip(0)
                    ->take($perPage)
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                $goodArticles = Article::where('type', '=', Article::TYPE_1)
                    ->where('state', '=', Article::STATE_1)
                    ->where('id', '<', $lastId)
                    ->take($perPage)
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        } else {
            //该标签的文章

            if ($lastId == 0) {
                //第一页

                $goodArticles = Tag::find($tagId)
                    ->articles()
                    ->where('type', '=', Article::TYPE_1)
                    ->where('state', '=', Article::STATE_1)
                    ->skip(0)
                    ->take($perPage)
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                $goodArticles = Tag::find($tagId)
                    ->articles()
                    ->where('type', '=', Article::TYPE_1)
                    ->where('state', '=', Article::STATE_1)
                    ->where('id', '<', $lastId)
                    ->take($perPage)
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        }

        $return = [
            'code' => 0,
            'msg' => 'ok',
            'data' => [
                'goodTags' => $goodTags,
                'goodArticles' => $goodArticles
            ]
        ];

        return response()->json($return);
    }

    /*
     * 获取恶文章和标签
     */
    public function postBadList(Request $request)
    {
        $all = $request->all();

        $badTags = Tag::where('type', '=', Tag::TYPE_2)
            ->orderBy('id', 'asc')
            ->get();

        $perPage = isset($all['perPage']) ? $all['perPage'] : Article::$perPage;
        $tagId = $all['tagId'];
        $lastId = $all['lastId'];

        if ($tagId == 0) {
            //全部文章

            if ($lastId == 0) {
                //第一页

                $badArticles = Article::where('type', '=', Article::TYPE_2)
                    ->where('state', '=', Article::STATE_1)
                    ->skip(0)
                    ->take($perPage)
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                $badArticles = Article::where('type', '=', Article::TYPE_2)
                    ->where('state', '=', Article::STATE_1)
                    ->where('id', '<', $lastId)
                    ->take($perPage)
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        } else {
            //该标签的文章

            if ($lastId == 0) {
                //第一页

                $badArticles = Tag::find($tagId)
                    ->articles()
                    ->where('type', '=', Article::TYPE_2)
                    ->where('state', '=', Article::STATE_1)
                    ->skip(0)
                    ->take($perPage)
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                $badArticles = Tag::find($tagId)
                    ->articles()
                    ->where('type', '=', Article::TYPE_2)
                    ->where('state', '=', Article::STATE_1)
                    ->where('id', '<', $lastId)
                    ->take($perPage)
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        }

        $return = [
            'code' => 0,
            'msg' => 'ok',
            'data' => [
                'badTags' => $badTags,
                'badArticles' => $badArticles
            ]
        ];

        return response()->json($return);
    }

    /*
     * 获取详情和评论
     */
    public function postContent(Request $request)
    {
        $all = $request->all();

        $id = $all['article_id'];

        $articleContent = Article::where('id', '=', $id)
            ->first();

        $articleComments = Article::find($id)
            ->comments()
            ->skip(0)
            ->take(Comment::$newNumber)
            ->orderBy('created_at', 'desc')
            ->get();


        $return = [
            'code' => 0,
            'msg' => 'ok',
            'data' => [
                'articleContent' => $articleContent,
                'articleComments' => $articleComments
            ]
        ];

        return response()->json($return);
    }

    /*
     * 写入赞/踩
     */
    public function postInsertPraise(Request $request)
    {
        $all = $request->all();

        $id = $all['article_id'];
        $type = $all['type'];

        $praiseResult = Article::where('id', '=', $id)
            ->increment('praise', 1);

        if ($praiseResult) {
            $return = [
                'code' => 0,
                'msg' => 'ok',
                'data' => null
            ];
        } else {
            $msg = '';

            if ($type == Article::TYPE_1) {
                $msg .= '表扬';
            } else if ($type == Article::TYPE_2) {
                $msg .= '鄙视';
            }

            $return = [
                'code' => 200001,
                'msg' => $msg . '失败',
                'data' => null
            ];
        }

        return response()->json($return);
    }

    /*
     * 写入评论
     */
    public function postInsertComment(Request $request)
    {
        $all = $request->all();

        $id = $all['article_id'];

        DB::beginTransaction();

        $commentData = [
            'user_id' => $all['user_id'],
            'article_id' => $all['article_id'],
            'content' => $all['content'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $commentResult = Comment::insert($commentData);


        $articleResult = Article::where('id', '=', $id)
            ->increment('comment', 1);


        if ($commentResult && $articleResult) {
            DB::commit();

            $return = [
                'code' => 0,
                'msg' => 'ok',
                'data' => null
            ];
        } else {
            DB::rollBack();

            $return = [
                'code' => 200001,
                'msg' => '评论失败',
                'data' => null
            ];
        }

        return response()->json($return);
    }

    /*
     * 获取评论
     */
    public function postCommentList(Request $request)
    {
        $all = $request->all();

        $id = $all['article_id'];

        $perPage = isset($all['perPage']) ? $all['perPage'] : Comment::$perPage;
        $lastId = $all['lastId'];

        if ($lastId == 0) {
            //第一页

            $comments = Article::find($id)
                ->comments()
                ->skip(0)
                ->take($perPage)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $comments = Article::find($id)
                ->comments()
                ->where('id', '<', $lastId)
                ->take($perPage)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $return = [
            'code' => 0,
            'msg' => 'ok',
            'data' => [
                'comments' => $comments
            ]
        ];

        return response()->json($return);
    }

    /*
     * 写入善/恶文章
     */
    public function postInsertArticle()
    {

    }

    /*
     * 登录
     */
    public function postLogin(Request $request)
    {
        $all = $request->all();

        $mobile = $all['mobile'];
        $password = $all['password'];

        $row = User::where('mobile', '=', $mobile)
            ->select('id', 'mobile', 'nickname', 'password', 'salt')
            ->first();

        if ($row) {
            $password = $row->salt . $password . $row->salt;

            if ($password == Crypt::decrypt($row->password)) {
                $return = [
                    'code' => 0,
                    'msg' => 'ok',
                    'data' => [
                        'user' => [
                            'id' => $row->id,
                            'mobile' => $row->mobile,
                            'nickname' => $row->nickname,
                        ]
                    ]
                ];
            } else {
                $return = [
                    'code' => 100002,
                    'msg' => '密码错误',
                    'data' => null
                ];
            }
        } else {
            $return = [
                'code' => 100001,
                'msg' => '手机号不存在',
                'data' => null
            ];
        }

        return response()->json($return);
    }

    /*
     * 注册
     */
    public function postRegister(Request $request)
    {
        $all = $request->all();

        $mobile = $all['mobile'];
        $code = $all['code'];
        $nickname = $all['nickname'];
        $password = $all['password'];

        $exist = User::where('mobile', '=', $mobile)
            ->first();

        if ($exist) {
            $return = [
                'code' => 100003,
                'msg' => '手机号已存在',
                'data' => null
            ];
            
            return response()->json($return);
        }

        $exist = User::where('nickname', '=', $nickname)
            ->first();

        if ($exist) {
            $return = [
                'code' => 100004,
                'msg' => '昵称已被占用',
                'data' => null
            ];

            return response()->json($return);
        }

        $salt = Util::generateSalt();

        $password = $salt . $password . $salt;
        $password = Crypt::encrypt($password);

        $data = [
            'mobile' => $mobile,
            'nickname' => $nickname,
            'password' => $password,
            'salt' => $salt,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $insertId = User::insertGetId($data);

        if ($insertId) {
            $return = [
                'code' => 0,
                'msg' => 'ok',
                'data' => [
                    'user' => [
                        'id' => $insertId,
                        'mobile' => $mobile,
                        'nickname' => $nickname,
                    ]
                ]
            ];
        } else {
            $return = [
                'code' => 100005,
                'msg' => '注册失败',
                'data' => null
            ];
        }

        return response()->json($return);
    }

    /*
     * 忘记密码
     */
    public function postResetPassword(Request $request)
    {
        $all = $request->all();

        $mobile = $all['mobile'];
        $code = $all['code'];
        $password = $all['password'];

        $row = User::where('mobile', '=', $mobile)
            ->first();

        if ($row) {
            $salt = Util::generateSalt();
            $password = $salt . $password . $salt;
            $password = Crypt::encrypt($password);

            $data = [
                'password' => $password,
                'salt' => $salt,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $result = User::where('id', '=', $row->id)
                ->update($data);
            if ($result) {
                $return = [
                    'code' => 0,
                    'msg' => 'ok',
                    'data' => null
                ];
            } else {
                $return = [
                    'code' => 100007,
                    'msg' => '重置密码失败',
                    'data' => null
                ];
            }
        } else {
            $return = [
                'code' => 100006,
                'msg' => '手机号不存在',
                'data' => null
            ];
        }

        return response()->json($return);
    }


}

?>
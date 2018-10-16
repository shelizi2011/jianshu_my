<?php

namespace App\Http\Controllers;

use App\Post;
use App\Validate\CreatePost;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 列表
    public function index(){
        $posts = Post::orderBy('created_at','desc') -> paginate(6);
        return view('post/index',compact('posts'));
    }
    // 详情页
    public function show(Post $post){
        return view('post/show',compact('post'));
    }
    // 创建页面
    public function create(){
        return view('post/create');
    }
    // 创建逻辑
    public function store(){
        (new CreatePost()) ->goCheck();
        $data = request(['title','content']);
        $post = Post::create(request(['title','content']));
        return redirect("/posts");
    }
    // 编辑页面
    public function edit(){
        return view('post/edit');
    }
    // 编辑逻辑
    public function update(){

    }
    // 删除逻辑
    public function delete(){

    }
    // 上传图片
    public function imageUpload(Request $request){
        $path = $request ->file('wangEditorFile') ->storePublicly(time());

        $result = [
            'errno' =>0,
            'data' =>[
                asset('storage/'.$path)
            ]
        ];
        return json_encode($result);
//        dd(request()->all());
    }
}

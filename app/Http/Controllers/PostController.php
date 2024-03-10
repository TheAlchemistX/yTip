<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:4|max:64',
            'content' => 'required|string|min:24|max:1024',
        ]);
        $validated['user_id'] = Auth::id();
        return response(Post::create($validated), 201);
    }

    public function read(Post $postId)
    {
        return response($postId, 200);
    }

    public function readAll(Request $request, Post $post)
    {
        return response($post->simplePaginate(10), 200);
    }

    public function readSort(Request $request, Post $post)
    {
        $sort = $request->query();
        $result = $post->orderBy($sort[key($sort)], key($sort))->simplePaginate(10);
        return response($result, 200);
    }
    public function readFilter(Request $request, Post $post)
    {
        $sort = $request->query();
        $result = $post->where(key($sort), $sort[key($sort)])->simplePaginate(10);
        return response($result, 200);
    }
    public function readGet(Request $request, Post $post)
    {
        $sort = $request->query();
        $fields = explode(',', $sort['fields']);
        return response($post->select($fields)->simplePaginate(10));
    }

    public function update(Request $request, Post $postId)
    {
        $this->authorize('private-post', $postId);
        $validated = $request->validate([
            'title' => 'required|string|min:4|max:64',
            'content' => 'required|string|min:24|max:1024',
        ]);
        return response(Post::where('id', $postId->id)->update($validated), 202);
    }

    public function destroy(Post $postId)
    {
        $this->authorize('private-post', $postId);
        return response($postId->delete(), 200);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostsRequest;
use App\Models\MediaLibrary;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Show the application posts index.
     */
    public function index(): View
    {
        return view('admin.posts.index', [
            'posts' => Post::withCount('comments', 'likes')->with('author')->latest()->paginate(50)
        ]);
    }

    /**
     * Display the specified resource edit form.
     */
    public function edit(Post $post): View
    {
        return view('admin.posts.edit', [
            'post' => $post,
            'users' => User::authors()->pluck('name', 'id'),
            'media' => MediaLibrary::first()->media()->get()->pluck('name', 'id'),
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        return view('admin.posts.create', [
            'users' => User::authors()->pluck('name', 'id'),
            'media' => MediaLibrary::first()->media()->get()->pluck('name', 'id'),
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostsRequest $request): RedirectResponse
    {
        Post::create($request->only(['title', 'content', 'posted_at', 'author_id', 'thumbnail_id', 'category_id']));

        return redirect()->route('admin.posts.index')->withSuccess(__('posts.created'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostsRequest $request, Post $post): RedirectResponse
    {
        if ($request->status === 'published') {
            $this->authorize('publish',  $post);
        }
        if ($request->status === 'deleted') {
            $this->authorize('delete',  $post);
            $post->delete();
            return redirect()->route('admin.posts.index')->withSuccess(__('posts.deleted'));
        }
        $user = Auth::user();
        $status = $request->status;
        if ($user->hasRole(Role::ROLE_AUTHOR) && $post->status === 'published') {
            if ($post->title != $request->title || $post->content != $request->content) {
                $status = 'review';
            }
        }
        $post->update(['status' => $status]);
        $post->update($request->only(['title', 'content', 'posted_at', 'author_id', 'thumbnail_id', 'category_id']));

        return redirect()->route('admin.posts.edit', $post)->withSuccess(__('posts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->withSuccess(__('posts.deleted'));
    }
}

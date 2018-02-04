<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use Illuminate\Http\Request;
use App\Services\UploadManager;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreatePostRequest;

class PostsController extends Controller
{
    protected $uploadManager;

    public function __construct(UploadManager $uploadManager)
    {
        $this->middleware(['auth', 'admin']);

        $this->uploadManager = $uploadManager;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create', [
            'post' => new Post,
            'allTags' => Tag::where('type', 'blog')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $validatedData = $request->postFillData();

        $post = Post::create($validatedData);

        if ($request->hasFile('image')) {
            $this->uploadManager->upload($post, $request, 'public/posts/images', 'image');
        }

        if ($request->has('tags')) {
            $post->syncTags($request->tags);
        }

        flash('Post has been saved!');

        return redirect()
            ->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post->load('tags');
        $allTags = Tag::where('type', 'blog')->get();

        return view('admin.posts.edit', compact('post', 'allTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePostRequest $request, Post $post)
    {
        $validatedData = $request->postFillData();

        if ($request->hasFile('image')) {
            
            $post->update($validatedData);

            $this->uploadManager->upload($post, $request, 'public/posts/images', 'image');

            if ($request->has('tags')) {
                $post->syncTags($request->tags);
            }

            flash('Post has been updated!');

            return redirect()
                ->route('posts.index');
        }

        $validatedData = collect($validatedData);

        $validatedData = $validatedData->except(['image'])->toArray();

        $post->update($validatedData);

        if($request->has('tags')) {
            $post->syncTags($request->tags);
        }

        flash('Post has been updated!');

        return redirect()
            ->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->image) {
            Storage::delete('public/posts/images/'.$post->image);
        }
                
        $post->delete();

        flash('The post has been deleted!');

        return redirect()
            ->route('posts.index');
    }

    public function deleteImage(Post $post)
    {
        if($post->image) {
            Storage::delete('public/posts/images/'.$post->image);
            $post->image = '';
            $post->save();
            flash('The image has been deleted!');
        }

        return back();
    }
}

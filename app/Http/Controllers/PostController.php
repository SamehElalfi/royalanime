<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginator = post::latest()->paginate(3);

        $primary_nav = true;

        // Slideshow Images
        $images = [
            [
                'src' => '/img/12.webp',
                'link' => cdn('/img/12.webp'),
                'alt' => cdn('/img/12.webp'),
            ],
            [
                'src' => '/img/12.webp',
                'link' => cdn('/img/12.webp'),
                'alt' => cdn('/img/12.webp'),
            ]
        ];

        return view('posts.index', compact('paginator', 'primary_nav', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate All input fields data
        $validatedData = $request->validate([
            "title" => "required",
            "content" => "required",
            "tags" => "nullable",
            "slug" => "nullable",
            "summary" => "nullable",
            "cover" => "image|mimes:jpeg,png,jpg,gif,svg",
        ]);

        $post = new Post();
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->tags = $request['tags'];
        $post->summary = $request['summary'];

        if ($request['slug']) {
            $post->slug = Str::slug($request['slug']);
        } else {
            $post->slug = Str::slug($request['title']);
        }



        if ($request->has('cover')) {
            $cover = time() . '.' . request()->cover->getClientOriginalExtension();
            request()->cover->move(public_path('images'), $cover);
            $cover = cdn('images/' . $cover);
        } else {
            $cover = Null;
        }
        $post->feature_image = $cover;

        $post->save();
        return back()->with('main', __('dashboard.A new post added to database successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

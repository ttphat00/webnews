<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::orderBy('id','DESC')->get(); 
        return response()->json($post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'image' => $request->get('image'),
            'content' => $request->get('content'),
            'time_created' => Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y'),
            'id_subcategory' => $request->get('id_subcategory'),
            'id_user' => $request->get('id_user'),
            'status' => $request->get('status')
        ]);
        $post->save();
        return response()->json('Subcategory Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->get('title');
        $post->description = $request->get('description');
        $post->image = $request->get('image');
        $post->content = $request->get('content');
        $post->time_created = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $post->id_subcategory = $request->get('id_subcategory');
        $post->id_user = $request->get('id_user');
        $post->status = $request->get('status');
        $post->save();
        return response()->json('Subcategory Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response()->json('Subcategory Deleted Successfully');
    }
}

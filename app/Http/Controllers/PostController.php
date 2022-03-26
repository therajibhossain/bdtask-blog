<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Redirect, JsonResponse as Response;

class PostController extends Controller
{
    private $_view = 'posts/index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() { 
        $data['posts'] = Post::orderBy('id', 'desc')->paginate(8);

        return view($this->_view, $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request) {
         $request->validate([
           'title'       => 'required|max:255',
         ]);

         $data = [
            'id' => $request->id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => null,
            'posted_by' => auth()->user()->id
         ];
         $post = Post::updateOrCreate($data);

        return $this->response($post, 'Post Saved successfully');
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $post = Post::find($id);

        // return Response::json($post);
        return $this->response($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $post = Post::find($id);

        // return response()->json($post);
        return $this->response($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $post = Post::find($id)->delete();

        // return Response::json($post);
        return $this->response($post);
    }
}
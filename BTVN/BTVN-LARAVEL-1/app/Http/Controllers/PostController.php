<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
class PostController extends Controller
{
/**
* Display a listing of the resource.
*/
    public function index()
    {
        $posts = Post::all();
        return view("posts.index", compact("posts"));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        Post::create($request->all());
        return redirect()->route('posts.index')
            ->with('success','Post created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        $post = Post::find($id);
        $post->update($request->all());
        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }


}
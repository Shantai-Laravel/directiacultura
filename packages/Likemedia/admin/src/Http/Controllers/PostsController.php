<?php

namespace Admin\Http\Controllers;

use App\Models\Post;
use App\Models\PostFile;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(15);

        return view('admin::admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('level', 1)->get();

        return view('admin::admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $toValidate = [];
        $toValidate['alias'] =  'required|unique:categories,alias|max:255';
        foreach ($this->langs as $lang){
            $toValidate['title_'.$lang->lang] = 'required|max:255';
        }

        $validator = $this->validate($request, $toValidate);

        $name = '';
        if ($request->file('image')) {
          $name = time() . '-' . $request->file('image')->getClientOriginalName();
          $request->file('image')->move('images/posts', $name);
        }

        $post = new Post();
        $post->category_id = $request->category_id;
        $post->image = $name;
        $post->alias = $request->alias;
        $post->date = date('Y-m-d H:i:s', strtotime("$request->date $request->time"));

        $request->on_home == 'on' ? $on_home = 1 : $on_home = 0;
        $post->on_home = $on_home;

        $post->save();

        foreach ($this->langs as $lang):
            $post->translations()->create([
                'lang_id' => $lang->id,
                'title' => request('title_' . $lang->lang),
                'body' => request('body_' . $lang->lang),
                'url' => request('url_' . $lang->lang),
                'meta_h1' => request('meta_h1_' . $lang->lang),
                'meta_title' => request('meta_title_' . $lang->lang),
                'meta_keywords' => request('meta_keywords_' . $lang->lang),
                'meta_description' => request('meta_description_' . $lang->lang)
            ]);

        endforeach;

        session()->flash('message', 'New item has been created!');

        return redirect()->route('posts.category', $request->category_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show method
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::find($id);

        return view('admin::admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $toValidate = [];
        $toValidate['alias'] =  'required|max:255';
        foreach ($this->langs as $lang){
            $toValidate['title_'.$lang->lang] = 'required|max:255';
        }

        $validator = $this->validate($request, $toValidate);

        $post = Post::findOrFail($id);
        $post->category_id = $request->category_id;
        $post->alias = $request->alias;
        $post->date = date('Y-m-d H:i:s', strtotime("$request->date $request->time"));

        $request->on_home == 'on' ? $on_home = 1 : $on_home = 0;
        $post->on_home = $on_home;

        if ($request->file('image')) {
            if (file_exists('images/posts/' . $post->image) && $post->image !== '') {
                unlink('images/posts/' . $post->image);
            }

            $name = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move('images/posts', $name);

            $post->image = $name;
        }

        $post->save();

        $post->translations()->delete();

        foreach ($this->langs as $lang):
            $post->translations()->create([
                'lang_id' => $lang->id,
                'title' => request('title_' . $lang->lang),
                'body' => request('body_' . $lang->lang),
                'url' => request('url_' . $lang->lang),
                'meta_h1' => request('meta_h1_' . $lang->lang),
                'meta_title' => request('meta_title_' . $lang->lang),
                'meta_keywords' => request('meta_keywords_' . $lang->lang),
                'meta_description' => request('meta_description_' . $lang->lang)
            ]);

        endforeach;

        session()->flash('message', 'Item has been edited!');

        return redirect()->route('posts.category', $request->category_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (file_exists('images/posts/' . $post->image) && $post->image !== '') {
            unlink('images/posts/' . $post->image);
        }

        $post->delete();

        session()->flash('message', 'Item has been deleted!');

        return redirect()->route('posts.index');
    }

    public function getPostsByCategory($categoryId)
    {
        $posts = Post::where('category_id', $categoryId)->with('translation')->paginate(15);
        $category = Category::with('translation')->find($categoryId);
        return view('admin::admin.posts.index', compact('posts', 'category'));
    }


    public function uploadImagesCkeditor(Request $request)
    {
        $CKEditor = $request->get('CKEditor');
        $funcNum = $request->get('CKEditorFuncNum');
        $message = $url = '';
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            if ($file->isValid()) {
                $filename = $file->getClientOriginalName();
                $file->move(public_path().'/images/ckeditor/', $filename);
                $url = '/images/ckeditor/' . $filename;
            } else {
                $message = 'An error occured while uploading the file.';
            }
        } else {
            $message = 'No file uploaded.';
        }
        return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use SEOMeta;
use Image;
use Storage;

class NewsController extends Controller
{

    /*
     *
     * SHOW ALL news
     *
     * */
    public function index()
    {
        $news = DB::table('News')->orderBy('id', 'desc')->paginate(2);

        SEOMeta::setTitle('Новости');

        return view('news', ['all_news' => $news]);
    }

    /*
     *
     * SHOW news
     *
     * */
    public function show($slug)
    {
        $news = DB::table('News')->where('slug', $slug)->first();

        SEOMeta::setTitle($news->title);
        SEOMeta::setDescription($news->description);
        SEOMeta::setKeywords($news->keywords);

        return view('single_news', ['news' => $news]);
    }

    /*
     *
     * CREATE news
     *
     * */
    public function create(Request $request)
    {
        $slug = str_slug($request->title, '_');

        if($request->hasFile('img'))
        {
            $img = $request->file('img');
            $filename = 'news-' . $slug . '-' . time() . '.' . $img->getClientOriginalExtension();

            $thumb_path = public_path('images/news/thumb/' . $filename);
            $full_path = public_path('images/news/full/' . $filename);

            Image::make($img->getRealPath())->fit(200, 200)->save($thumb_path);
            Image::make($img->getRealPath())->save($full_path);
        }
        else
        {
            $filename = 'default.png';
        }

        DB::table('News')->insert([
            'title'         => $request->title,
            'slug'          => $slug,
            'description'   => $request->description,
            'keywords'      => $request->keywords,
            'text'          => $request->text,
            'img'           => $filename,
        ]);

        return redirect()->route('news');
    }

    /*
     *
     * DELETE удаление новости и её изображений
     *
     * */
    public function delete($id){

        $post = DB::table('News')->where('id', $id);

        $thumb_path = 'images/news/thumb/' . $post->value('img');
        $full_path  = 'images/news/full/' . $post->value('img');

        Storage::disk('public')->delete([$thumb_path, $full_path]);
        $post->delete();

        return redirect()->route('news');

    }
}

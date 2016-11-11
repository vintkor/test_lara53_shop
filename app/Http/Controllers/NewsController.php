<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use SEOMeta;
use Image;

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

//        if($request->hasFile('img'))
//        {
//            dd($request);
//        }

        DB::table('News')->insert([
            'title'         => $request->title,
            'slug'          => $slug,
            'description'   => $request->description,
            'keywords'      => $request->keywords,
            'text'          => $request->text,
        ]);

        return redirect()->route('news');
    }

    /*
     *
     * DELETE news
     *
     * */
    public function delete($id){

        DB::table('News')->where('id', $id)->delete();

        return redirect()->route('news');

    }
}

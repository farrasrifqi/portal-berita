<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FrontEndController extends Controller
{
    public function index()
    {
        $title = "Zenblog";
        $news = News::latest()->get();
        $nav_category = Category::all();
        $slider = Slider::all();
        $side_news = News::inRandomOrder()->limit(4)->get();

        return view('frontend.index', compact('title', 'news', 'slider', 'nav_category', 'side_news'));
    }

    public function detailCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $text = Category::findOrFail($category->id)->name;
        $title = "Detail Category - $text";
        $news     = News::where('category_id', $category->id)->paginate(10);
        $nav_category = Category::all();
        $side_news = News::inRandomOrder()->limit(4)->get();

        return view('frontend.detail-category', compact('title', 'category', 'news', 'nav_category', 'side_news'));
    }

    public function detailNews($slug)
    {
        $news = News::where('slug', $slug)->first();
        $text = News::findOrFail($news->id)->title;
        $title = "Berita - $text";
        $nav_category = Category::all();
        $side_news = News::inRandomOrder()->limit(4)->get();

        return view('frontend.detail-news', compact('title', 'news', 'nav_category', 'side_news'));
    }

    public function searchNewsEnd(Request $request)
    {
        $title = "Search News";
        $keyword = $request->keyword;
        $news = News::where('title', 'like', '%' . $keyword . '%')->paginate(10);
        $slider = Slider::all();
        $nav_category = Category::all();
        $side_news = News::inRandomOrder()->limit(4)->get();



        return view('frontend.index', compact('title', 'news', 'slider', 'nav_category', 'side_news'));
    }
}

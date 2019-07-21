<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\CurrentNew;
use App\Repositories\CurrentNewRepository;

use Session;
use Image;

class CurrentNewController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(CurrentNewRepository $newRepo) {
    	if (Auth::user()->type != 'user' && Auth::user()->type != 'admin') {
			return redirect()->route('login');
		}

		$news = $newRepo->getAllNews();

		return view('news.news', ['news' => $news]);
    }

    public function single(CurrentNewRepository $newRepo, $news_id) {
        if (Auth::user()->type != 'user' && Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }
        $news = $newRepo->find($news_id);

        return view('news.single', ['news' => $news]);
    }

    public function create() {
        if (Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }
        return view('news.create');
    }

    public function store(Request $request) {
        if (Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }

        $request->validate([
            'title' => 'required|max:100',
            'content' => 'required',
            'date' => 'required',
            'image' => 'image|mimes:png,jpeg,jpg|max:3072'
        ]);

        $news = new CurrentNew;
        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->date = $request->input('date');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            $img = Image::make($image)->resize(800, 480)->save($location);

            $news->image = $filename;
        }

        $news->save();

        return redirect('/news');
    }

    public function edit(CurrentNewRepository $newRepo, $news_id) {
        if (Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }

        $news = $newRepo->find($news_id);

        return view('news.edit', ['news' => $news]);
    }

    public function editStore(Request $request, CurrentNewRepository $newRepo) {
        if (Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }

        $request->validate([
            'title' => 'required|max:100',
            'content' => 'required',
        ]);

        $news = $newRepo->find($request->input('news_id'));

        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->save();

        return redirect('/news');
    }

    public function delete(CurrentNewRepository $newRepo,$news_id) {
        if (Auth::user()->type != 'admin') {
            return redirect()->route('login');
        }

        $news = $newRepo->find($news_id);
        if ($news->image != null) {
            unlink(public_path('images/'.$news->image));
        }

        $newRepo->delete($news_id);
        return redirect('/news');
    }
}
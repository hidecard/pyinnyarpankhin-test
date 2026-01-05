<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::where('is_active', true)->latest()->take(3)->get();
        $events = Event::where('is_active', true)->latest()->take(3)->get();

        return view('home', [
            'news' => $news,
            'events' => $events,
        ]);
    }
}

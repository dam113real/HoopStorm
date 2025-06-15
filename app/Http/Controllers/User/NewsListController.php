<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\NoticiaResource;

use App\Models\News;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NewsListController extends Controller
{

    public function index()
{
    $news = News::with('news_images')->get();

    return Inertia::render(
        'User/NewsList',
        [
            'news' => $news,
        ]
    );
}
  
}

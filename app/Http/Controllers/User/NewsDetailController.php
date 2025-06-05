<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NewsDetailController extends Controller
{
    public function show(News $news)
    {
        $news->load(['news_images']);
        return Inertia::render('User/NewsDetail', [
            'news' => $news,
        ]);
    }
}

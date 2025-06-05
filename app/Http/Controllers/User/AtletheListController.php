<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Atlethe;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AtletheListController extends Controller
{

    public function index()
{
    $atlethes = Atlethe::with('atlethe_images')->get();

    return Inertia::render(
        'User/AtletheList',
        [
            'atlethes' => $atlethes,
        ]
    );
}
  
}

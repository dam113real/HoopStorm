<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Atlethe;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AtletheDetailController extends Controller
{
    public function show(Atlethe $atlethe)
    {
        $atlethe->load(['atlethe_images']);
        return Inertia::render('User/AtletheDetail', [
            'atlethe' => $atlethe,
        ]);
    }
}

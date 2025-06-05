<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $products = Product::with('brand', 'category', 'product_images')->orderBy('id','desc')->get();

        // Verificar si el usuario actual es un administrador
      //  $isAdmin = Auth::check() && Auth::user()->isAdmin == 1;

        return Inertia::render('User/Index', [
            'products' => $products,
            'canLogin' => app('router')->has('login'),
            'canRegister' => app('router')->has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
           // 'isAdmin' => $isAdmin, // Pasar el estado de administrador a la vista
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        // Obtener el usuario actualmente autenticado
        $user = auth()->user();
        
        // Verificar si el usuario es un administrador
        $isAdmin = $user && $user->isAdmin;

        // Renderizar la vista y pasar la propiedad isAdmin a la vista
        return Inertia::render('Admin/Dashboard', [
            'isAdmin' => $isAdmin,
        ]);
    }
}

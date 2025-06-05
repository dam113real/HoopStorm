<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Recupera los pedidos del usuario actual con los productos y sus imágenes asociadas
        $orders = Order::with(['order_items.product.product_images', 'order_items.product.brand', 'order_items.product.category'])
                       ->where('created_by', $userId)
                       ->get();
        
        // Calcula el total del pedido sumando los precios de los productos en cada pedido
        $total = $orders->sum(function ($order) {
            return $order->order_items->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });
        });

        return Inertia::render('User/Dashboard', ['orders' => $orders, 'total' => $total]);
    }
}


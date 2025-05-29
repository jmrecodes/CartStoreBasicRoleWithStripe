<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(6); // Paginate with 6 products per page
        return view('products.index', compact('products'));
    }

    // Other resourceful methods can be added here later if needed (create, store, show, edit, update, destroy)
}

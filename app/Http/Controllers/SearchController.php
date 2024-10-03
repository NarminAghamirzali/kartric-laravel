<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('query');
        
        // Search for products
        $products = Product::where('title', 'LIKE', '%' . $search . '%')->get();

        // Search for services
        $services = Service::where('title', 'LIKE', '%' . $search . '%')->get();

        // Search for blogs
        $blogs = Blog::where('title', 'LIKE', '%' . $search . '%')->get();

        // Search for categories
        $categories = Category::where('name', 'LIKE', '%' . $search . '%')->get();

        // Combine results
        $results = [
            'products' => $products,
            'services' => $services,
            'blogs' => $blogs,
            'categories' => $categories,
        ];

        return response()->json($results);
    }
}

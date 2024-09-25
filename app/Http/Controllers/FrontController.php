<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\LangController;
use App\Models\About;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function getLangs(){
        $langsFromLangs = app(LangController::class);
        $langs = $langsFromLangs->getLangs();
        return $langs;
    }
    public function home()
    {
        $services = Service::all();
        $banners = Banner::all();
        $abouts = About::all();
        $partners = Partner::all();
        $products = Product::all()->reverse()->take(6)->reverse();
        $blogs = Blog::all()->reverse()->take(3)->reverse();
        return view('front.home.index', compact('services', 'banners', 'abouts', 'products', 'blogs', 'partners'));
    }

    public function about()
    {
        $abouts = About::all();
        return view('front.about.index', compact('abouts'));
    }

    public function contact()
    {
        $contacts = Contact::all();
        return view('front.contact.index', compact(var_name: 'contacts'));
    }

    public function services()
    {
        $services = Service::all();
        return view('front.services.index', compact('services'));
    }

    public function showService(Service $service)
    {
        return view('front.services.show', compact('service'));
    }

    public function blog()
    {
        $blogs = Blog::all();
        $categories = Category::all();
        return view('front.blog.index', compact('blogs', 'categories'));
    }

    public function showBlog(Blog $blog)
    {   
        $categories = Category::all();
        $blogs = Blog::all();
        return view('front.blog.show', compact('blog', 'blogs', 'categories'));
    }
    public function products()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('front.product.index', compact('products', 'categories'));
    }

    public function showProduct(Product $product)
    {
        $categories = Category::all();
        return view('front.product.show', compact('product', 'categories'));
    }
    public function showCategory(Category $category)
    {
        $products = Product::where('category_id', $category->id)->get();
        $categories = Category::all();
        return view('front.product.category', compact('products', 'category', 'categories'));
    }
}

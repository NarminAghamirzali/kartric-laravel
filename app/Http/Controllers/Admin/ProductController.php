<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductFormRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\DataService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $dataService;
    public function __construct(DataService $dataService) {
        $this->dataService = $dataService;
    }
    public function getLangs(){
        $langsFromLangs = app(LangController::class);
        $langs = $langsFromLangs->getLangs();
        return $langs;
    }
    public function index()
    {
        $products = Product::all();
        
        $langs = $this->getLangs();
        return view('admin.product.index', compact('products', 'langs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $langs = $this->getLangs();
        $categories = Category::all();
        return view('admin.product.create', compact('langs', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductFormRequest $request)
    {
        $data = $request->validated();
        $product = new Product;

        foreach ($data["title"] as $langs => $lang) {
            $product->setTranslation('title', $langs, $lang);
        }
        foreach ($data["description"] as $langs => $lang) {
            $product->setTranslation('description', $langs, $lang);
        }
        foreach ($data["short_description"] as $langs => $lang) {
            $product->setTranslation('short_description', $langs, $lang);
        }
        foreach ($data["technical_description"] as $langs => $lang) {
            $product->setTranslation('technical_description', $langs, $lang);
        }
        foreach ($data["title"] as $langs => $lang) {
            $product->setTranslation('slug', $langs, $this->dataService->sluggable($lang));
        }
        $product->price = $data['price'];
        $product->category_id = $data['category_id'];
        if($data['image']->isValid()){
            $product->image = "storage/".$data['image']->store('uploads', 'public');
        }
        $product->save();
        return redirect('admin/products')->with('message',"Product has been created successfully!");

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $products = Product::all();
        return view('front.product.index', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $langs = $this->getLangs();
        $categories = Category::all();
        $product['titles'] = $product->getTranslations('title');
        $product['descriptions'] = $product->getTranslations('description');
        $product['short_descriptions'] = $product->getTranslations('short_description');
        $product['technical_descriptions'] = $product->getTranslations('technical_description');
        return view('admin.product.edit', compact('product', 'langs', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductFormRequest $request, Product $product)
    {
        $data = $request->validated();

        foreach ($data["title"] as $langs => $lang) {
            $product->setTranslation('title', $langs, $lang);
        }
        foreach ($data["description"] as $langs => $lang) {
            $product->setTranslation('description', $langs, $lang);
        }
        foreach ($data["short_description"] as $langs => $lang) {
            $product->setTranslation('short_description', $langs, $lang);
        }
        foreach ($data["technical_description"] as $langs => $lang) {
            $product->setTranslation('technical_description', $langs, $lang);
        }
        foreach ($data["title"] as $langs => $lang) {
            $product->setTranslation('slug', $langs, $this->dataService->sluggable($lang));
        }
        $product->price = $data['price'];
        $product->category_id = $data['category_id'];
        if ($request->hasFile('image')) {
            if ($product->image && file_exists(storage_path('app/public/' . str_replace('storage/', '', $product->image)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $product->image)));
            }
            $product->image = 'storage/' . $request->file('image')->store('uploads', 'public');
        }
        $product->update();
        return redirect('admin/products')->with('message',"Product has been updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if($product){
            $product->delete();
            return redirect('admin/products')->with('message',"Product has been deleted successfully!");
        }else {
            return redirect('admin/products')->with('message',"No product id founded!");
        }
    }
}

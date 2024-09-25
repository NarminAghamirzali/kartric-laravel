<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryFormRequest;
use App\Models\Category;
use App\Services\DataService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
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
        $categories = Category::all();
        $langs = $this->getLangs();
        return view('admin.category.index', compact('categories', 'langs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $langs = $this->getLangs();
        return view('admin.category.create', compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryFormRequest $request)
    {
        $data = $request->validated();
        $category = new Category;

        foreach ($data["name"] as $langs => $lang) {
            $category->setTranslation('name', $langs, $lang);
        }
        foreach ($data["name"] as $langs => $lang) {
            $category->setTranslation('slug', $langs, $this->dataService->sluggable($lang));
        }
        $category->save();
        return redirect('admin/categories')->with('message',"Category has been created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $categories = Category::all();
        return view('front.category.index', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $langs = $this->getLangs();
        $category['names'] = $category->getTranslations('name');
        return view('admin.category.edit', compact('category', 'langs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryFormRequest $request, Category $category)
    {
        $data = $request->validated();
        
        foreach ($data["name"] as $langs => $lang) {
            $category->setTranslation('name', $langs, $lang);
        }
        foreach ($data["name"] as $langs => $lang) {
            $category->setTranslation('slug', $langs, $this->dataService->sluggable($lang));
        }
        $category->save();
        return redirect('admin/categories')->with('message',"Category has been updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            // Attempt to delete the category
            Category::findOrFail($category->id)->delete();
            return redirect()->back()->with('success', 'Category deleted successfully.');
        } catch (QueryException $e) {
            // Log the error for debugging purposes (optional)
            Log::error($e->getMessage());

            // Check if it's a foreign key constraint violation
            if($e->getCode() === '23000') {
                // Return a user-friendly error message
                return redirect()->back()->with('error', 'You cannot delete this category because it has associated products.');
            }

            // For any other exception, return a general error message
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}

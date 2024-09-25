<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\BlogFormRequest;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Lang;
use App\Services\DataService;

class BlogController extends Controller
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
        $blogs = Blog::all();
        
        $langs = $this->getLangs();
        return view('admin.blog.index', compact('blogs', 'langs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $langs = $this->getLangs();
        return view('admin.blog.create', compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogFormRequest $request)
    {
        $data = $request->validated();
        $blog = new Blog;

        foreach ($data["title"] as $langs => $lang) {
            $blog->setTranslation('title', $langs, $lang);
        }
        foreach ($data["description"] as $langs => $lang) {
            $blog->setTranslation('description', $langs, $lang);
        }
        foreach ($data["title"] as $langs => $lang) {
            $blog->setTranslation('slug', $langs, $this->dataService->sluggable($lang));
        }

        if($data['image']->isValid()){
            $blog->image = "storage/".$data['image']->store('uploads', 'public');
        }
        $blog->save();
        return redirect('admin/blogs')->with('message',"Blog has been created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        // return view('front.blog.show', compact('blog')); // Load the front-end blog view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $langs = $this->getLangs();
        $blog['titles'] = $blog->getTranslations('title');
        $blog['descriptions'] = $blog->getTranslations('description');
        return view('admin.blog.edit', compact('blog', 'langs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogFormRequest $request, Blog $blog)
    {
        $data = $request->validated();
        
        foreach ($data["title"] as $langs => $lang) {
            $blog->setTranslation('title', $langs, $lang);
        }
        foreach ($data["description"] as $langs => $lang) {
            $blog->setTranslation('description', $langs, $lang);
        }
        foreach ($data["title"] as $langs => $lang) {
            $blog->setTranslation('slug', $langs, $this->dataService->sluggable($lang));
        }
        if ($request->hasFile('image')) {
            if ($blog->image && file_exists(storage_path('app/public/' . str_replace('storage/', '', $blog->image)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $blog->image)));
            }
            $blog->image = 'storage/' . $request->file('image')->store('uploads', 'public');
        }
        $blog->update();
        return redirect('admin/blogs')->with('message',"Blog has been updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if($blog){
            $blog->delete();
            return redirect('admin/blogs')->with('message',"Blog has been deleted successfully!");
        }else {
            return redirect('admin/blogs')->with('message',"No blog id founded!");
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerFormRequest;
use App\Models\Banner;
use App\Services\DataService;

class BannerController extends Controller
{
    private $dataService;
    public function __construct(DataService $dataService) {
        $this->dataService = $dataService;
    }
    public function getLangs(){
        $langsFromLangs = app(LangController::class);
        $langs = $langsFromLangs->getLangs();
        return $langs;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::all();
        $langs = $this->getLangs();
        return view('admin.banner.index', compact('banners', 'langs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $langs = $this->getLangs();
        return view('admin.banner.create', compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerFormRequest $request)
    {
        $data = $request->validated();
        $banner = new Banner;

        foreach ($data["title"] as $langs => $lang) {
            $banner->setTranslation('title', $langs, $lang);
        }
        foreach ($data["description"] as $langs => $lang) {
            $banner->setTranslation('description', $langs, $lang);
        }

        if($data['image']->isValid()){
            $banner->image = "storage/".$data['image']->store('uploads', 'public');
        }
        $banner->save();
        return redirect('admin/banners')->with('message',"Banner has been created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        $langs = $this->getLangs();
        $banner['titles'] = $banner->getTranslations('title');
        $banner['descriptions'] = $banner->getTranslations('description');
        return view('admin.banner.edit', compact('banner', 'langs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerFormRequest $request, Banner $banner)
    {
        $data = $request->validated();
        
        foreach ($data["title"] as $langs => $lang) {
            $banner->setTranslation('title', $langs, $lang);
        }
        foreach ($data["description"] as $langs => $lang) {
            $banner->setTranslation('description', $langs, $lang);
        }
        if ($request->hasFile('image')) {
            if ($banner->image && file_exists(storage_path('app/public/' . str_replace('storage/', '', $banner->image)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $banner->image)));
            }
            $banner->image = 'storage/' . $request->file('image')->store('uploads', 'public');
        }
        $banner->update();
        return redirect('admin/banners')->with('message',"Banner has been updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        if($banner){
            $banner->delete();
            return redirect('admin/banners')->with('message',"Banner has been deleted successfully!");
        }else {
            return redirect('admin/banners')->with('message',"No banner id founded!");
        }
    }
}

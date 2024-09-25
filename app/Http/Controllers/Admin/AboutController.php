<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutFormRequest;
use App\Models\About;
use App\Services\DataService;

class AboutController extends Controller
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
        $abouts = About::all();
        $langs = $this->getLangs();
        return view('admin.about.index', compact('abouts', 'langs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $langs = $this->getLangs();
        return view('admin.about.create', compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutFormRequest $request)
    {
        $data = $request->validated();
        $about = new About;

        foreach ($data["about"] as $langs => $lang) {
            $about->setTranslation('about', $langs, $lang);
        }
        foreach ($data["mission"] as $langs => $lang) {
            $about->setTranslation('mission', $langs, $lang);
        }

        if($data['image']->isValid()){
            $about->image = "storage/".$data['image']->store('uploads', 'public');
        }
        $about->save();
        return redirect('admin/abouts')->with('message',"About has been created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        $langs = $this->getLangs();
        $about['abouts'] = $about->getTranslations('about');
        $about['missions'] = $about->getTranslations('mission');
        return view('admin.about.edit', compact('about', 'langs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutFormRequest $request, About $about)
    {
        $data = $request->validated();
        
        foreach ($data["about"] as $langs => $lang) {
            $about->setTranslation('about', $langs, $lang);
        }
        foreach ($data["mission"] as $langs => $lang) {
            $about->setTranslation('mission', $langs, $lang);
        }
        if ($request->hasFile('image')) {
            if ($about->image && file_exists(storage_path('app/public/' . str_replace('storage/', '', $about->image)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $about->image)));
            }
            $about->image = 'storage/' . $request->file('image')->store('uploads', 'public');
        }
        $about->update();
        return redirect('admin/abouts')->with('message',"About has been updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        if($about){
            $about->delete();
            return redirect('admin/abouts')->with('message',"About has been deleted successfully!");
        }else {
            return redirect('admin/abouts')->with('message',"No about id founded!");
        }
    }
}

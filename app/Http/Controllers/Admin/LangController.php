<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LangFormRequest;
use App\Models\About;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Lang;
use App\Models\Service;
use App\Models\Team;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getLangs(){
        $languages = Lang::all();
        $langs = [];
        foreach($languages as $language){
            array_push( $langs, $language['code']);
        }
        return $langs;
    }
    public function index()
    {
        $langs = Lang::all();
        return view('admin.lang.index', compact('langs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $langs = LaravelLocalization::getSupportedLocales();
        $codes = $this->getLangs();
        $unique = array_diff(array_keys($langs), $codes); 
        return view('admin.lang.create', compact('unique'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LangFormRequest $request)
    {
        $data = $request->validated();
        $lang = new Lang;

        $lang->name = $data['name'];
        $lang->code = $data['code'];
        if($data['flag']->isValid()){
            $lang->flag= "storage/".$data['flag']->store('uploads', 'public');
        }
        $lang->save();
        return redirect('admin/langs')->with('message',"Lang has been created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Lang $lang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lang $lang)
    {
        $langs = LaravelLocalization::getSupportedLocales();
        $codes = $this->getLangs();
        $unique = array_diff(array_keys($langs), $codes);
        array_unshift($unique, $lang['code']);

        return view('admin.lang.edit', compact('unique', 'lang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LangFormRequest $request, Lang $lang)
    {
        $data = $request->validated();

        $lang->name = $data['name'];
        $lang->code = $data['code'];
        
        if ($request->hasFile('flag')) {
            // Delete the old image if it exists
            if ($lang->flag && file_exists(storage_path('app/public/' . str_replace('storage/', '', $lang->flag)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $lang->flag)));
            }
    
            // Store the new image
            $lang->flag = 'storage/' . $request->file('flag')->store('uploads', 'public');
        }
        $lang->update();
        return redirect('admin/langs')->with('message',"Langs has been updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lang $lang)
    {
        $language = Lang::findOrFail($lang->id);
        if (!$language) {
            return redirect()->back()->with('error', 'Language not found.');
        }

//         Check if the language is used in tables
        $blogModel = new Blog();
        $usedBlogLanguages = $blogModel->getAllUsedLanguages();

        $categoryModel = new Category();
        $usedCategoryLanguages = $categoryModel->getAllUsedLanguages();

        $aboutModel = new About();
        $usedAboutLanguages = $aboutModel->getAllUsedLanguages();

        $bannerModel = new Banner();
        $usedBannerLanguages = $bannerModel->getAllUsedLanguages();

        $serviceModel = new Service();
        $usedServiceLanguages = $serviceModel->getAllUsedLanguages();

        $teamModel = new Team();
        $usedTeamLanguages = $teamModel->getAllUsedLanguages();

        if (in_array($language->code, $usedBlogLanguages) || in_array($language->code, $usedCategoryLanguages) || in_array($language->code, $usedAboutLanguages) ||
            in_array($language->code, $usedBannerLanguages) || in_array($language->code, $usedServiceLanguages) || in_array($language->code, $usedTeamLanguages)) {
            return redirect()->back()->with('error', 'This language cannot be deleted because it is associated with one or more tables.');
        }
        
//         Proceed with deletion if it's safe
        $language->delete();

        return redirect()->back()->with('message', 'Language deleted successfully.');
    }
}

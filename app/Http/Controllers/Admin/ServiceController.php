<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceFormRequest;
use App\Models\Service;
use App\Services\DataService;
use Illuminate\Http\Request;

class ServiceController extends Controller
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
        $services = Service::all();
        
        $langs = $this->getLangs();
        return view('admin.service.index', compact('services', 'langs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $langs = $this->getLangs();
        return view('admin.service.create', compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceFormRequest $request)
    {
        $data = $request->validated();
        $service = new Service;

        foreach ($data["title"] as $langs => $lang) {
            $service->setTranslation('title', $langs, $lang);
        }
        foreach ($data["description"] as $langs => $lang) {
            $service->setTranslation('description', $langs, $lang);
        }
        foreach ($data["title"] as $langs => $lang) {
            $service->setTranslation('slug', $langs, $this->dataService->sluggable($lang));
        }

        if($data['image']->isValid()){
            $service->image = "storage/".$data['image']->store('uploads', 'public');
        }
        $service->save();
        return redirect('admin/services')->with('message',"Service has been created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        $services = Service::all();
        return view('front.service.index', compact('services'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $langs = $this->getLangs();
        $service['titles'] = $service->getTranslations('title');
        $service['descriptions'] = $service->getTranslations('description');
        return view('admin.service.edit', compact('service', 'langs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceFormRequest $request, Service $service)
    {
        $data = $request->validated();
        
        foreach ($data["title"] as $langs => $lang) {
            $service->setTranslation('title', $langs, $lang);
        }
        foreach ($data["description"] as $langs => $lang) {
            $service->setTranslation('description', $langs, $lang);
        }
        foreach ($data["title"] as $langs => $lang) {
            $service->setTranslation('slug', $langs, $this->dataService->sluggable($lang));
        }
        if ($request->hasFile('image')) {
            if ($service->image && file_exists(storage_path('app/public/' . str_replace('storage/', '', $service->image)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $service->image)));
            }
            $service->image = 'storage/' . $request->file('image')->store('uploads', 'public');
        }
        $service->update();
        return redirect('admin/services')->with('message',"Service has been updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if($service){
            $service->delete();
            return redirect('admin/services')->with('message',"Service has been deleted successfully!");
        }else {
            return redirect('admin/services')->with('message',"No service id founded!");
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PartnerFormRequest;
use App\Models\Partner;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::all();
        return view('admin.partner.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PartnerFormRequest $request)
    {
        $data = $request->validated();
        $partner = new Partner;

        $partner->name = $data['name'];
        if($data['image']->isValid()){
            $partner->image = "storage/".$data['image']->store('uploads', 'public');
        }
        $partner->save();
        return redirect('admin/partners')->with('message',"Partner has been created successfully!");

    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        return view('admin.partner.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PartnerFormRequest $request, Partner $partner)
    {
        $data = $request->validated();

        $partner->name = $data['name'];
        if ($request->hasFile('image')) {
            if ($partner->image && file_exists(storage_path('app/public/' . str_replace('storage/', '', $partner->image)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $partner->image)));
            }
            $partner->image = 'storage/' . $request->file('image')->store('uploads', 'public');
        }
        $partner->update();
        return redirect('admin/partners')->with('message',"Partner has been updated successfully!");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        if($partner){
            $partner->delete();
            return redirect('admin/partners')->with('message',"Partner has been deleted successfully!");
        }else {
            return redirect('admin/partners')->with('message',"No partner id founded!");
        }
    }
}

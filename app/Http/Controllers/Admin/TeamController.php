<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeamFormRequest;
use App\Models\Team;
use App\Services\DataService;

class TeamController extends Controller
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
        $teams = Team::all();
        
        $langs = $this->getLangs();
        return view('admin.team.index', compact('teams', 'langs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $langs = $this->getLangs();
        return view('admin.team.create', compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamFormRequest $request)
    {
        $data = $request->validated();
        $team = new Team;

        foreach ($data["name"] as $langs => $lang) {
            $team->setTranslation('name', $langs, $lang);
        }
        foreach ($data["position"] as $langs => $lang) {
            $team->setTranslation('position', $langs, $lang);
        }

        if($data['image']->isValid()){
            $team->image = "storage/".$data['image']->store('uploads', 'public');
        }
        $team->save();
        return redirect('admin/teams')->with('message',"Team has been created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        $langs = $this->getLangs();
        $team['names'] = $team->getTranslations('name');
        $team['positions'] = $team->getTranslations('position');
        return view('admin.team.edit', compact('team', 'langs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamFormRequest $request, Team $team)
    {
        $data = $request->validated();
        
        foreach ($data["name"] as $langs => $lang) {
            $team->setTranslation('name', $langs, $lang);
        }
        foreach ($data["position"] as $langs => $lang) {
            $team->setTranslation('position', $langs, $lang);
        }
        if ($request->hasFile('image')) {
            if ($team->image && file_exists(storage_path('app/public/' . str_replace('storage/', '', $team->image)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $team->image)));
            }
            $team->image = 'storage/' . $request->file('image')->store('uploads', 'public');
        }
        $team->update();
        return redirect('admin/teams')->with('message',"Team has been updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        if($team){
            $team->delete();
            return redirect('admin/teams')->with('message',"Team has been deleted successfully!");
        }else {
            return redirect('admin/teams')->with('message',"No team id founded!");
        }
    }
}

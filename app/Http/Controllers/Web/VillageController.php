<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\VillageService;

class VillageController extends Controller
{
    protected $villageService;

    public function __construct(VillageService $villageService)
    {
        $this->villageService = $villageService;
    }

    public function index()
    {
        $villages = $this->villageService->getPaginatedVillages(15);
        return view('admin.villages', compact('villages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $this->villageService->createVillage($validated);
        return back()->with('success', 'تم إضافة القرية بنجاح');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $this->villageService->updateVillage($id, $validated);
        return back()->with('success', 'تم تعديل القرية بنجاح');
    }

    public function destroy($id)
    {
        $this->villageService->deleteVillage($id);
        return back()->with('success', 'تم حذف القرية بنجاح');
    }
}

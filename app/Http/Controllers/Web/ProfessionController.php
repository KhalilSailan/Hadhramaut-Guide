<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProfessionService;

class ProfessionController extends Controller
{
    protected $professionService;

    public function __construct(ProfessionService $professionService)
    {
        $this->professionService = $professionService;
    }

    public function index()
    {
        $professions = $this->professionService->getPaginatedProfessions(15);
        return view('admin.professions', compact('professions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $this->professionService->createProfession($validated);
        return back()->with('success', 'تم إضافة المهنة بنجاح');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $this->professionService->updateProfession($id, $validated);
        return back()->with('success', 'تم تعديل المهنة بنجاح');
    }

    public function destroy($id)
    {
        $this->professionService->deleteProfession($id);
        return back()->with('success', 'تم حذف المهنة بنجاح');
    }
}

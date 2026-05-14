<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\VillageService;
use App\Services\ProfessionService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;

class DirectoryController extends Controller
{
    protected $userService;
    protected $villageService;
    protected $professionService;

    public function __construct(UserService $userService, VillageService $villageService, ProfessionService $professionService)
    {
        $this->userService = $userService;
        $this->villageService = $villageService;
        $this->professionService = $professionService;
    }

    public function index(Request $request)
    {
        $filters = [
            'search' => $request->query('search'),
            'village_id' => $request->query('village_id'),
            'profession_id' => $request->query('profession_id'),
        ];

        $users = $this->userService->filterUsers($filters, 10);
        $villages = $this->villageService->getAllVillages();
        $professions = $this->professionService->getAllProfessions();
        
        return view('directory.index', compact('users', 'villages', 'professions'));
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            abort(404);
        }
        return view('directory.show', compact('user'));
    }

    public function settings()
    {
        $user = Auth::user()->load('village', 'profession');
        $villages = $this->villageService->getAllVillages();
        $professions = $this->professionService->getAllProfessions();
        return view('settings.profile', compact('user', 'villages', 'professions'));
    }

    public function updateSettings(UpdateProfileRequest $request)
    {
        $this->userService->updateProfile(Auth::id(), $request->validated());
        return redirect()->route('settings.profile')->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }
}

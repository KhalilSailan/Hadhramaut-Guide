<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Village;
use App\Models\Profession;

class AdminController extends Controller
{
    protected $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function profile()
    {
        /** @var User|null $user */
        $user = Auth::user();

        if ($user) {
            $user->load('village', 'profession');
        }

        return view('admin.profile', compact('user'));
    }

    public function dashboard(Request $request)
    {
        $userCount = \App\Models\User::count();
        $villageCount = Village::count();
        $professionCount = Profession::count();
        $numbersCount = \App\Models\User::count();

        $filters = [
            'search' => $request->query('search'),
            'village_id' => $request->query('village_id'),
            'profession_id' => $request->query('profession_id'),
        ];

        if ($request->query('filter_type') === 'village') {
            $filters['profession_id'] = null;
        }

        if ($request->query('filter_type') === 'profession') {
            $filters['village_id'] = null;
        }

        $users = $this->userService->filterUsers($filters, 10);
        $villages = Village::orderBy('name')->get();
        $professions = Profession::orderBy('name')->get();

        return view('admin.dashboard', compact(
            'userCount',
            'villageCount',
            'professionCount',
            'numbersCount',
            'users',
            'villages',
            'professions'
        ));
    }

    public function users(Request $request)
    {
        if ($request->filled('search')) {
            $users = $this->userService->searchUsers($request->search, 15);
        } else {
            $users = $this->userService->getPaginatedUsers(15);
        }

        $villages = Village::orderBy('name')->get();
        $professions = Profession::orderBy('name')->get();

        return view('admin.users', compact('users', 'villages', 'professions'));
    }

    public function numbers(Request $request)
    {
        if ($request->filled('search')) {
            $users = $this->userService->searchUsers($request->search, 15);
        } else {
            $users = $this->userService->getPaginatedUsers(15);
        }

        $villages = Village::orderBy('name')->get();
        $professions = Profession::orderBy('name')->get();

        return view('admin.numbers', compact('users', 'villages', 'professions'));
    }

    public function createUser()
    {
        $villages = Village::orderBy('name')->get();
        $professions = Profession::orderBy('name')->get();

        return view('admin.users.create', compact('villages', 'professions'));
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20|unique:users,phone',
            'type' => 'required|in:true,false',
            'role' => 'required|in:user,admin',
            'password' => 'required|string|min:8|confirmed',
            'village_id' => 'required|exists:villages,id',
            'profession_id' => 'required|exists:professions,id',
        ]);

        $this->userService->createUser($validated);

        return redirect()->route('admin.users.index')->with('success', 'تم إضافة المستخدم بنجاح');
    }

    public function editUser($id)
    {
        $user = $this->userService->getUserById($id);
        $villages = Village::orderBy('name')->get();
        $professions = Profession::orderBy('name')->get();

        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'المستخدم غير موجود');
        }

        return view('admin.users.edit', compact('user', 'villages', 'professions'));
    }

    public function updateUser(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|max:20|unique:users,phone,' . $id,
            'type' => 'required|in:true,false',
            'role' => 'required|in:user,admin',
            'password' => 'nullable|string|min:8|confirmed',
            'village_id' => 'required|exists:villages,id',
            'profession_id' => 'required|exists:professions,id',
        ]);

        $this->userService->updateProfile($id, $validated);

        return redirect()->route('admin.users.index')->with('success', 'تم تحديث بيانات المستخدم بنجاح');
    }

    public function showUser($id)
    {
        return redirect()->route('admin.users.edit', $id);
    }

    public function destroyUser($id)
    {
        $this->userService->deleteUser($id);
        return redirect()->route('admin.users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }
}

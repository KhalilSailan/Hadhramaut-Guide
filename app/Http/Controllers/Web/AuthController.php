<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Services\VillageService;
use App\Services\ProfessionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetCodeMail;
use Carbon\Carbon;

class AuthController extends Controller
{
    protected $authService;
    protected $villageService;
    protected $professionService;

    public function __construct(AuthService $authService, VillageService $villageService, ProfessionService $professionService)
    {
        $this->authService = $authService;
        $this->villageService = $villageService;
        $this->professionService = $professionService;
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        if ($this->authService->attemptLogin($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/directory');
        }

        return back()->withErrors([
            'phone' => 'The provided credentials do not match our records.',
        ])->onlyInput('phone');
    }

    public function showRegister()
    {
        $villages = $this->villageService->getAllVillages();
        $professions = $this->professionService->getAllProfessions();
        return view('auth.register', compact('villages', 'professions'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users',
            'email' => 'required|email|unique:users,email',
            'type' => 'required|in:true,false,default:false',
            'role' => 'sometimes|in:user',
            'password' => 'required|string|min:8|confirmed', 
            'village_id' => 'required|exists:villages,id',
            'profession_id' => 'required|exists:professions,id',
        ]);
        $validated['password'] = Hash::make($validated['password']);

        User::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'type' => $validated['type'] ?? 'false',
            'role' => 'user',
            'password' => $validated['password'],
            'village_id' => $validated['village_id'],
            'profession_id' => $validated['profession_id'],
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendForgotPasswordLink(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiresIn = config('auth.passwords.users.expire');

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $validated['email']],
            ['token' => Hash::make($code), 'created_at' => Carbon::now()]
        );

        $this->sendEmailMessage($validated['email'], $code, $expiresIn);

        return redirect()->route('password.reset', ['email' => $validated['email']])
            ->with('status', "تم إرسال كود إعادة التعيين إلى بريدك الإلكتروني. ينتهي في {$expiresIn} دقيقة.");
    }

    public function showResetPasswordForm(Request $request)
    {
        return view('auth.reset-password', [
            'email' => $request->query('email', ''),
            'expiresIn' => config('auth.passwords.users.expire'),
        ]);
    }

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'code' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $validated['email'])
            ->first();

        if (! $record || ! Hash::check($validated['code'], $record->token) || Carbon::parse($record->created_at)->addMinutes(config('auth.passwords.users.expire'))->isPast()) {
            return back()->withErrors([
                'code' => 'الكود غير صالح أو منتهي الصلاحية.',
            ]);
        }

        $user = User::where('email', $validated['email'])->first();
        if (! $user) {
            return back()->withErrors([
                'email' => 'لم نتمكن من العثور على المستخدم.',
            ]);
        }

        $user->password = Hash::make($validated['password']);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $validated['email'])->delete();

        return redirect()->route('login')->with('success', 'تم تحديث كلمة المرور بنجاح. يمكنك تسجيل الدخول الآن.');
    }

    protected function sendEmailMessage(string $email, string $code, int $expiresIn): void
    {
        try {
            Mail::to($email)->send(new PasswordResetCodeMail($code, $expiresIn));
        } catch (\Throwable $exception) {
            Log::error('Password reset email failed: ' . $exception->getMessage(), [
                'email' => $email,
                'code' => $code,
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            return redirect()->route('admin.dashboard', ['admin_id' => $admin->id]);
        }

        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ]);
    }

    public function showRegisterForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $admin = $this->create($request->all());

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.dashboard', ['admin_id' => $admin->id]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function logoutAdmin(Request $request)
    {
        Auth::guard('admin')->logout(); // Déconnexion de l'administrateur
        $request->session()->invalidate(); // Invalider la session
        $request->session()->regenerateToken(); // Régénérer le jeton de session

        return redirect('/admin/login');
    }

    public function dashboard($admin_id)
    {
        $userCount = User::count(); // Compte le nombre total d'utilisateurs
        $admin = Admin::findOrFail($admin_id); // Récupère les détails de l'admin

        return view('admin.dashboard', compact('admin', 'userCount'));
    }
}

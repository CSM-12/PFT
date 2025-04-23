<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Login
    public function login(LoginRequest $request)
    {
        try {
            
            $credentials = $request->validated(); // Extract validated input as an array
            $remember = $request->boolean('remember'); // Ensure 'remember' is a boolean
            

            // Authentication
            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate(); // Prevent session fixation

                // Prepare alert message
                session()->flash('alerts', [
                    'success' => ['Sign in successfull!']
                ]);

                // Redirect to dashboard
                return redirect()->route('dashboard'); // Redirect to the intended page
            }

            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Invalide credentials!']
            ]);

            // Return to login
            return back()->withErrors(['email' => 'Invalid credentials']);
        } catch (\Exception $e) {
            // Log error message
            Log::error("Error logging in  user: " . $e->getMessage());

            // Prepare alert message
            session()->flash('alerts', [
                'danger' => ['Something went wrong while signing in!']
            ]);

            // Return to games index page
            return redirect()->back();
        }
    }

    // Register
    public function register(RegisterRequest $request)
    {
        try {
            // Create and save user
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Log the user in
            Auth::login($user);

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Sign up successfull, please sign in!']
            ]);

            // Redirect to dashboard or home
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            // Log error message
            Log::error("Error registering user: " . $e->getMessage());

            // Return to games index page
            return redirect()->back();
        }
    }

    // Logout
    public function logout(Request $request)
    {
        try {
            Auth::logout(); // Log the user out

            $request->session()->invalidate(); // Invalidate the session
            $request->session()->regenerateToken(); // Regenerate CSRF token for security

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Sign out successfully, please sign in!']
            ]);

            // Redirect to login page
            return redirect()->route('login');
        } catch (\Exception $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'danger' => ['Something went wrong while signing out!']
            ]);

            // Return to games index page
            return redirect()->back();
        }
    }
}

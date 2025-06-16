<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SendResetFormRequest;
use App\Http\Requests\Saving\UpdateSavingRequest;
use App\Models\User;
use App\Repositories\Contracts\Auth\SettingRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class AuthController extends Controller
{
     // Repository
    private $settingRepository;

    // Inject the repository into the controller
    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

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

    // Forgot password page
    public function forgotPassword()
    {
        return view('pages.authentication.forgot-password');
    }

    // Send forgot password link 
    public function sendForgotPasswordLink(SendResetFormRequest $request)
    {
        try {
            // Send reset password link
            $status = Password::sendResetLink(
                $request->only('email')
            );

            // Check status
            if ($status === Password::RESET_LINK_SENT) {
                // Prepare alert message
                session()->flash('alerts', [
                    'success' => ['Reset password link sent on your email!']
                ]);
            } else {
                // Prepare alert message
                session()->flash('alerts', [
                    'warning' => ['Something went wrong while sending reset link!']
                ]);
            }

            // Return to reset form page
            return redirect()->back();
        } catch (\Exception $e) {
            // Log error message
            Log::error("Error sending reset password link: " . $e->getMessage());

            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Something went wrong while sending reset link!']
            ]);

            // Return to games index page
            return redirect()->back();
        }
    }

    // Password reset form
    public function showResetForm(Request $request, $token)
    {
        return view('pages.authentication.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password),
                        'remember_token' => Str::random(60),
                    ])->save();

                    // Fire an event
                    // event(new PasswordReset($user));
                }
            );

            if ($status == Password::PASSWORD_RESET) {
                // Prepare alert message
                session()->flash('alerts', [
                    'success' => ['Password reset successfully!']
                ]);

                // Redirect on login page
                return redirect()->route('login');
            } else {
                // Prepare alert message
                session()->flash('alerts', [
                    'warning' => ['Something went wrong while resetting password!']
                ]);

                // Redirect back
                return redirect()->back();
            }
        } catch (\Exception $e) {
            // Log error message
            Log::error("Error sending reset password link: " . $e->getMessage());

            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Something went wrong while resetting password!']
            ]);

            // Return to games index page
            return redirect()->back();
        }
    }

    public function showSettings ()
    {
        try {
            $settings = $this->settingRepository->index();

            // Get Settings
            return view('pages.settings', compact('settings'));
        } catch (\Exception $e) {
            // Log error message
            Log::error("Error fetching settings: " . $e->getMessage());

            // Prepare alert message
            session()->flash('alerts', [
                'error' => ['Something went wrong while showing settings!']
            ]);

            // Return to back page
            return redirect()->back();
        }
    }

    public function updateSettings (UpdateSavingRequest $request)
    {
        try {
            // Update settings
            $this->settingRepository->update($request->all());

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Settings updated!']
            ]);

            // Return to index page
            return redirect()->route('settings');
        } catch (\Exception $e) {
            // Prepare alert Massages
            session()->flash('alerts', [
                'error' => ['Settings not modified!', 'Something went wrong while modifing settings!']
            ]);

            // Log error message
            Log::error("Something went wrong while modifing settings: " . $e->getMessage());

            // Return to edit pages
            return redirect()->back();
        }
    }
}

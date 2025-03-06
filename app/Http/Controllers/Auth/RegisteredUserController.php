<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Exception;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'student_number' => ['required', 'string', 'max:20', 'unique:'.Student::class],
                'department' => ['required', 'string', 'max:100'],
                'year_level' => ['required', 'string', 'in:1,2,3,4,5'],
                'semester' => ['required', 'string', 'in:1st,2nd,Summer'],
                'address' => ['nullable', 'string', 'max:255'],
                'birthdate' => ['nullable', 'date', 'before:today'],
                'contact_number' => ['nullable', 'string', 'max:20'],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student',
                'is_verified' => false,
            ]);

            // Create the student record
            $student = Student::create([
                'user_id' => $user->id,
                'student_number' => $request->student_number,
                'department' => $request->department,
                'year_level' => $request->year_level,
                'semester' => $request->semester,
                'address' => $request->address,
                'birthdate' => $request->birthdate,
                'contact_number' => $request->contact_number,
            ]);

            event(new Registered($user));

            Auth::login($user);

            // Explicitly redirect to dashboard
            return redirect()->route('dashboard');
        } catch (Exception $e) {
            // Log the error
            Log::error('Registration error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            // Redirect back with error
            return back()->withInput()->withErrors(['registration_error' => 'Registration failed: ' . $e->getMessage()]);
        }
    }
}

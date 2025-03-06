<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(): View
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $students = Student::with('user')->paginate(10);
        return view('students.index', compact('students'));
    }

    public function show(Student $student): View
    {
        if (!auth()->user()->isAdmin() && auth()->id() !== $student->user_id) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('students.show', compact('student'));
    }

    public function edit(Student $student): View
    {
        if (!auth()->user()->isAdmin() && auth()->id() !== $student->user_id) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        if (!auth()->user()->isAdmin() && auth()->id() !== $student->user_id) {
            abort(403, 'Unauthorized action.');
        }
        
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                Rule::unique('users')->ignore($student->user_id)
            ],
            'address' => ['nullable', 'string', 'max:255'],
            'birthdate' => ['nullable', 'date', 'before:today'],
            'contact_number' => ['nullable', 'string', 'max:20'],
        ];
        
        if (auth()->user()->isAdmin()) {
            $adminRules = [
                'student_number' => [
                    'required', 
                    'string', 
                    'max:20', 
                    Rule::unique('students')->ignore($student->id)
                ],
                'department' => ['required', 'string', 'max:100'],
                'year_level' => ['required', 'string', 'in:1,2,3,4,5'],
            ];
            
            $rules = array_merge($rules, $adminRules);
        }
        
        $validated = $request->validate($rules);
        
        $student->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);
        
        $studentData = [
            'address' => $validated['address'],
            'birthdate' => $validated['birthdate'],
            'contact_number' => $validated['contact_number'],
        ];
        
        if (auth()->user()->isAdmin()) {
            $adminData = [
                'student_number' => $validated['student_number'],
                'department' => $validated['department'],
                'year_level' => $validated['year_level'],
            ];
            
            $studentData = array_merge($studentData, $adminData);
        }
        
        $student->update($studentData);

        return redirect()->route('students.show', $student)
            ->with('success', 'Profile updated successfully.');
    }

    public function verificationList(): View
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $unverifiedStudents = Student::whereHas('user', function($query) {
            $query->where('is_verified', false);
        })->with('user')->paginate(10);

        return view('students.verification', compact('unverifiedStudents'));
    }

    public function verify(Student $student)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $student->user->update(['is_verified' => true]);

        return redirect()->route('students.verification')
            ->with('success', 'Student verified successfully.');
    }

    public function pending()
    {
        return view('students.pending');
    }
} 
<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EnrollmentController extends Controller
{
    public function create(Student $student): View
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Get subjects that match the student's department and year level
        // and that the student is not already enrolled in
        $availableSubjects = Subject::where('department', $student->department)
            ->where('year_level', $student->year_level)
            ->whereDoesntHave('students', function($query) use ($student) {
                $query->where('student_id', $student->id);
            })
            ->get();
        
        return view('enrollments.create', compact('student', 'availableSubjects'));
    }
    
    public function store(Request $request, Student $student)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'subjects' => 'required|array',
            'subjects.*' => 'exists:subjects,id',
        ]);
        
        // Attach each selected subject to the student
        foreach ($validated['subjects'] as $subjectId) {
            $student->subjects()->attach($subjectId);
        }
        
        return redirect()->route('students.show', $student)
            ->with('success', 'Student enrolled in subjects successfully.');
    }
    
    public function destroy(Student $student, Subject $subject)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $student->subjects()->detach($subject->id);
        
        return back()->with('success', 'Student unenrolled from subject successfully.');
    }
} 
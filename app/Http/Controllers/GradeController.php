<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GradeController extends Controller
{
    public function edit(Student $student, Subject $subject): View
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if the student is enrolled in this subject
        $enrollment = $student->subjects()->where('subject_id', $subject->id)->first();
        
        if (!$enrollment) {
            abort(404, 'Student is not enrolled in this subject.');
        }
        
        return view('grades.edit', compact('student', 'subject', 'enrollment'));
    }
    
    public function update(Request $request, Student $student, Subject $subject)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'grade' => 'required|in:1.0,1.25,1.5,1.75,2.0,2.25,2.5,2.75,3.0,5.0',
        ]);
        
        // Update the grade in the pivot table
        $student->subjects()->updateExistingPivot($subject->id, [
            'grade' => $validated['grade']
        ]);
        
        return redirect()->route('students.show', $student)
            ->with('success', 'Grade updated successfully.');
    }
} 
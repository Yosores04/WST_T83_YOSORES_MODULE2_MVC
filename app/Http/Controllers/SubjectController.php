<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubjectController extends Controller
{
    public function index(Request $request): View
    {
        $query = Subject::query();
        
        // Apply filters if provided
        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }
        
        if ($request->filled('year_level')) {
            $query->where('year_level', $request->year_level);
        }
        
        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }
        
        $subjects = $query->paginate(10);
        
        return view('subjects.index', compact('subjects'));
    }
    
    public function show(Subject $subject)
    {
        try {
            // Try to load the students relationship
            $subject->load('students');
            return view('subjects.show', compact('subject'));
        } catch (\Exception $e) {
            // If there's an error (like missing table), just return the view without the relationship
            return view('subjects.show', compact('subject'));
        }
    }
    
    public function create(): View
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('subjects.create');
    }
    
    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:subjects',
            'name' => 'required|string|max:255',
            'units' => 'required|integer|min:1|max:6',
            'department' => 'required|string|max:50',
            'year_level' => 'required|integer|min:1|max:5',
            'semester' => 'required|integer|in:1,2',
            'description' => 'nullable|string',
        ]);
        
        Subject::create($validated);
        
        return redirect()->route('subjects.index')
            ->with('success', 'Subject created successfully.');
    }
    
    public function edit(Subject $subject): View
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('subjects.edit', compact('subject'));
    }
    
    public function update(Request $request, Subject $subject)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'units' => 'required|integer|min:1|max:6',
            'department' => 'required|string|max:50',
            'year_level' => 'required|integer|min:1|max:5',
            'semester' => 'required|integer|in:1,2',
            'description' => 'nullable|string',
        ]);
        
        $subject->update($validated);
        
        return redirect()->route('subjects.show', $subject)
            ->with('success', 'Subject updated successfully.');
    }
    
    public function destroy(Subject $subject)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if there are students enrolled in this subject
        if ($subject->students()->count() > 0) {
            return back()->with('error', 'Cannot delete subject with enrolled students.');
        }
        
        $subject->delete();
        
        return redirect()->route('subjects.index')
            ->with('success', 'Subject deleted successfully.');
    }
} 
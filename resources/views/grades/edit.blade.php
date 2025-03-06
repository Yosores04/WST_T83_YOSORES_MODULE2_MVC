<x-app-layout>
    <x-slot name="title">
        Update Grade - {{ $student->user->name }} - {{ $subject->code }}
    </x-slot>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Update Student Grade
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card-custom">
                <div class="card-body-custom">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="text-2xl font-bold">Update Grade</h2>
                        <a href="{{ route('students.show', $student) }}" 
                           class="btn-secondary-custom">
                            Back to Student
                        </a>
                    </div>

                    <div class="bg-light p-4 rounded mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="text-muted mb-1">Student Name</p>
                                <p class="fw-semibold">{{ $student->user->name }}</p>
                            </div>
                            <div class="col-md-3">
                                <p class="text-muted mb-1">Student Number</p>
                                <p class="fw-semibold">{{ $student->student_number }}</p>
                            </div>
                            <div class="col-md-3">
                                <p class="text-muted mb-1">Subject Code</p>
                                <p class="fw-semibold">{{ $subject->code }}</p>
                            </div>
                            <div class="col-md-3">
                                <p class="text-muted mb-1">Subject Name</p>
                                <p class="fw-semibold">{{ $subject->name }}</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('grades.update', [$student, $subject]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="grade" class="form-label-custom">
                                Grade *
                            </label>
                            <select name="grade" 
                                   id="grade" 
                                   class="form-control-custom"
                                   required>
                                <option value="">Select a grade</option>
                                
                                <optgroup label="Passing Grades">
                                    <option value="1.0" {{ old('grade', $enrollment->pivot->grade ?? '') == '1.0' ? 'selected' : '' }}>1.0 (Excellent)</option>
                                    <option value="1.25" {{ old('grade', $enrollment->pivot->grade ?? '') == '1.25' ? 'selected' : '' }}>1.25</option>
                                    <option value="1.5" {{ old('grade', $enrollment->pivot->grade ?? '') == '1.5' ? 'selected' : '' }}>1.5</option>
                                    <option value="1.75" {{ old('grade', $enrollment->pivot->grade ?? '') == '1.75' ? 'selected' : '' }}>1.75</option>
                                    <option value="2.0" {{ old('grade', $enrollment->pivot->grade ?? '') == '2.0' ? 'selected' : '' }}>2.0</option>
                                    <option value="2.25" {{ old('grade', $enrollment->pivot->grade ?? '') == '2.25' ? 'selected' : '' }}>2.25</option>
                                    <option value="2.5" {{ old('grade', $enrollment->pivot->grade ?? '') == '2.5' ? 'selected' : '' }}>2.5</option>
                                    <option value="2.75" {{ old('grade', $enrollment->pivot->grade ?? '') == '2.75' ? 'selected' : '' }}>2.75</option>
                                    <option value="3.0" {{ old('grade', $enrollment->pivot->grade ?? '') == '3.0' ? 'selected' : '' }}>3.0 (Passing)</option>
                                </optgroup>
                                
                                <optgroup label="Failing Grade">
                                    <option value="5.0" {{ old('grade', $enrollment->pivot->grade ?? '') == '5.0' ? 'selected' : '' }}>5.0 (Failed)</option>
                                </optgroup>
                            </select>
                            
                            @error('grade')
                                <p class="text-danger mt-1 small">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn-primary-custom">
                                Update Grade
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
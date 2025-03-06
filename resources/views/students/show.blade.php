<x-app-layout>
    <x-slot name="title">
        Student - {{ $student->user->name }}
    </x-slot>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Student Details
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card-custom">
                <div class="card-body-custom">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="text-2xl font-bold">Student Information</h2>
                        <div class="d-flex gap-2">
                            <a href="{{ route('students.index') }}" 
                               class="btn-secondary-custom">
                                Back to List
                            </a>
                            
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('enrollments.create', $student) }}" 
                                   class="btn-success-custom">
                                    Enroll in Subjects
                                </a>
                            @endif
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert-success-custom" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="bg-light p-4 rounded mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="h5 fw-bold mb-3">Personal Information</h3>
                                <div class="mb-3">
                                    <p class="text-muted mb-1">Name</p>
                                    <p class="fw-semibold">{{ $student->user->name }}</p>
                                </div>
                                <div class="mb-3">
                                    <p class="text-muted mb-1">Email</p>
                                    <p class="fw-semibold">{{ $student->user->email }}</p>
                                </div>
                                <div class="mb-3">
                                    <p class="text-muted mb-1">Student Number</p>
                                    <p class="fw-semibold">{{ $student->student_number }}</p>
                                </div>
                                @if($student->address)
                                <div class="mb-3">
                                    <p class="text-muted mb-1">Address</p>
                                    <p class="fw-semibold">{{ $student->address }}</p>
                                </div>
                                @endif
                                @if($student->birthdate)
                                <div class="mb-3">
                                    <p class="text-muted mb-1">Birthdate</p>
                                    <p class="fw-semibold">{{ $student->birthdate->format('F d, Y') }}</p>
                                </div>
                                @endif
                                @if($student->contact_number)
                                <div class="mb-3">
                                    <p class="text-muted mb-1">Contact Number</p>
                                    <p class="fw-semibold">{{ $student->contact_number }}</p>
                                </div>
                                @endif
                                
                                @if(auth()->user()->isAdmin() || auth()->id() === $student->user_id)
                                <div class="mt-3">
                                    <a href="{{ route('students.edit', $student) }}" class="btn-primary-custom">
                                        Edit Profile
                                    </a>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h3 class="h5 fw-bold mb-3">Academic Information</h3>
                                <div class="mb-3">
                                    <p class="text-muted mb-1">Department</p>
                                    <p class="fw-semibold">{{ $student->department }}</p>
                                </div>
                                <div class="mb-3">
                                    <p class="text-muted mb-1">Year Level</p>
                                    <p class="fw-semibold">{{ $student->year_level }}</p>
                                </div>
                                <div class="mb-3">
                                    <p class="text-muted mb-1">Status</p>
                                    <p>
                                        @if($student->user->is_verified)
                                            <span class="badge-success-custom">
                                                Verified
                                            </span>
                                        @else
                                            <span class="badge-warning-custom">
                                                Pending
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @php
                        $gwaData = $student->calculateGWA();
                        $academicStanding = $student->getAcademicStanding($gwaData['gwa']);
                    @endphp
                    
                    <div class="bg-light p-4 rounded mb-4">
                        <h3 class="h5 fw-bold mb-3">Academic Performance</h3>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card text-center h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title text-muted">GWA</h5>
                                        <p class="display-4 fw-bold mb-0">
                                            {{ $gwaData['gwa'] > 0 ? $gwaData['gwa'] : 'N/A' }}
                                        </p>
                                        <p class="text-muted small">
                                            {{ $gwaData['graded_units'] }}/{{ $gwaData['total_units'] }} units graded
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title text-muted">Standing</h5>
                                        <p class="h4 fw-bold mb-0">
                                            {{ $academicStanding }}
                                        </p>
                                        @if($gwaData['gwa'] > 0)
                                            @if($academicStanding == 'University Scholar')
                                                <span class="badge bg-primary mt-2">Excellent</span>
                                            @elseif($academicStanding == 'College Honors')
                                                <span class="badge bg-success mt-2">Very Good</span>
                                            @elseif($academicStanding == 'Passed')
                                                <span class="badge bg-info mt-2">Good</span>
                                            @else
                                                <span class="badge bg-danger mt-2">Failed</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title text-muted">Total Units</h5>
                                        <p class="display-4 fw-bold mb-0">
                                            {{ $gwaData['total_units'] }}
                                        </p>
                                        <p class="text-muted small">Enrolled</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title text-muted">Subjects</h5>
                                        <p class="display-4 fw-bold mb-0">
                                            {{ $student->subjects->count() }}
                                        </p>
                                        <p class="text-muted small">Enrolled</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="h4 fw-bold mb-3">Enrolled Subjects</h3>
                    
                    @if($student->subjects->count() > 0)
                        <div class="table-responsive">
                            <table class="table-custom">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Units</th>
                                        <th>Semester</th>
                                        <th>Grade</th>
                                        @if(auth()->user()->isAdmin())
                                        <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($student->subjects as $subject)
                                        <tr>
                                            <td>{{ $subject->code }}</td>
                                            <td>{{ $subject->name }}</td>
                                            <td>{{ $subject->units }}</td>
                                            <td>{{ $subject->semester }}</td>
                                            <td>
                                                @if($subject->pivot->grade)
                                                    <span class="fw-bold 
                                                        @if($subject->pivot->grade <= 1.5) text-primary
                                                        @elseif($subject->pivot->grade <= 2.0) text-success
                                                        @elseif($subject->pivot->grade <= 3.0) text-info
                                                        @else text-danger
                                                        @endif">
                                                        {{ $subject->pivot->grade }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">Not graded</span>
                                                @endif
                                            </td>
                                            @if(auth()->user()->isAdmin())
                                            <td>
                                                <a href="{{ route('grades.edit', [$student, $subject]) }}" class="action-link action-link-edit">
                                                    Update Grade
                                                </a>
                                                
                                                <form action="{{ route('enrollments.destroy', [$student, $subject]) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="action-link action-link-delete border-0 bg-transparent p-0"
                                                            onclick="return confirm('Are you sure you want to unenroll this student?')">
                                                        Unenroll
                                                    </button>
                                                </form>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert-warning-custom" role="alert">
                            <p>This student is not enrolled in any subjects yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
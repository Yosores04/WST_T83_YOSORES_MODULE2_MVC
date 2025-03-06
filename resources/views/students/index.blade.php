<x-app-layout>
    <x-slot name="title">
        Students
    </x-slot>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card-custom">
                <div class="card-body-custom">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="text-2xl font-bold">Students List</h2>
                    </div>

                    @if(session('success'))
                        <div class="alert-success-custom" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <!-- Search and Filter Form -->
                    <form action="{{ route('students.index') }}" method="GET" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="search" class="form-label-custom">Search</label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                       class="form-control-custom"
                                       placeholder="Name or Student Number">
                            </div>
                            
                            <div class="col-md-3">
                                <label for="department" class="form-label-custom">Department</label>
                                <select name="department" id="department" class="form-control-custom">
                                    <option value="">All Departments</option>
                                    <option value="Computer Science" {{ request('department') == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
                                    <option value="Information Technology" {{ request('department') == 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
                                    <option value="Information Systems" {{ request('department') == 'Information Systems' ? 'selected' : '' }}>Information Systems</option>
                                </select>
                            </div>
                            
                            <div class="col-md-2">
                                <label for="year_level" class="form-label-custom">Year Level</label>
                                <select name="year_level" id="year_level" class="form-control-custom">
                                    <option value="">All Years</option>
                                    <option value="1" {{ request('year_level') == '1' ? 'selected' : '' }}>1st Year</option>
                                    <option value="2" {{ request('year_level') == '2' ? 'selected' : '' }}>2nd Year</option>
                                    <option value="3" {{ request('year_level') == '3' ? 'selected' : '' }}>3rd Year</option>
                                    <option value="4" {{ request('year_level') == '4' ? 'selected' : '' }}>4th Year</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn-primary-custom me-2">
                                    Filter
                                </button>
                                
                                <a href="{{ route('students.index') }}" class="btn-secondary-custom">
                                    Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Students Table -->
                    <div class="table-responsive">
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th>Student Number</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Year Level</th>
                                    <th>GWA</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $student)
                                    @php
                                        $gwaData = $student->calculateGWA();
                                        $academicStanding = $student->getAcademicStanding($gwaData['gwa']);
                                    @endphp
                                    <tr>
                                        <td>{{ $student->student_number }}</td>
                                        <td>{{ $student->user->name }}</td>
                                        <td>{{ $student->department }}</td>
                                        <td>{{ $student->year_level }}</td>
                                        <td>
                                            @if($gwaData['gwa'] > 0)
                                                <span class="fw-bold 
                                                    @if($gwaData['gwa'] <= 1.5) text-primary
                                                    @elseif($gwaData['gwa'] <= 2.0) text-success
                                                    @elseif($gwaData['gwa'] <= 3.0) text-info
                                                    @else text-danger
                                                    @endif">
                                                    {{ $gwaData['gwa'] }}
                                                </span>
                                                <span class="d-block small text-muted">{{ $academicStanding }}</span>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($student->user->is_verified)
                                                <span class="badge-success-custom">
                                                    Verified
                                                </span>
                                            @else
                                                <span class="badge-warning-custom">
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('students.show', $student) }}" class="action-link action-link-view">
                                                View
                                            </a>
                                            <a href="{{ route('enrollments.create', $student) }}" class="action-link action-link-edit">
                                                Enroll
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-gray-500">
                                            No students found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $students->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
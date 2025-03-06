<x-app-layout>
    <x-slot name="title">
        Enroll Student - {{ $student->user->name }}
    </x-slot>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Enroll in Subjects
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card-custom">
                <div class="card-body-custom">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="text-2xl font-bold">Enroll Student in Subjects</h2>
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
                                <p class="text-muted mb-1">Department</p>
                                <p class="fw-semibold">{{ $student->department }}</p>
                            </div>
                            <div class="col-md-3">
                                <p class="text-muted mb-1">Year Level</p>
                                <p class="fw-semibold">{{ $student->year_level }}</p>
                            </div>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert-success-custom" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert-danger-custom" role="alert">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    @if($availableSubjects->count() > 0)
                        <form action="{{ route('enrollments.store', $student) }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <h3 class="h5 fw-bold mb-3">Available Subjects</h3>
                                <p class="text-muted mb-3">Select the subjects you want to enroll this student in:</p>
                                
                                <div class="table-responsive">
                                    <table class="table-custom">
                                        <thead>
                                            <tr>
                                                <th width="50">
                                                    <input type="checkbox" id="select-all" class="form-check-input">
                                                </th>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Units</th>
                                                <th>Semester</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($availableSubjects as $subject)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="subjects[]" value="{{ $subject->id }}" class="form-check-input subject-checkbox">
                                                    </td>
                                                    <td>{{ $subject->code }}</td>
                                                    <td>{{ $subject->name }}</td>
                                                    <td>{{ $subject->units }}</td>
                                                    <td>{{ $subject->semester }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="flex justify-end mt-4">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow" style="background-color: #2563eb; color: white;">
                                    Enroll in Selected Subjects
                                </button>
                            </div>
                        </form>
                        
                        <script>
                            // JavaScript to handle "Select All" functionality
                            document.getElementById('select-all').addEventListener('change', function() {
                                const isChecked = this.checked;
                                document.querySelectorAll('.subject-checkbox').forEach(checkbox => {
                                    checkbox.checked = isChecked;
                                });
                            });
                        </script>
                    @else
                        <div class="alert-warning-custom" role="alert">
                            <p>No available subjects found for this student's department and year level.</p>
                        </div>
                        
                        <a href="{{ route('students.show', $student) }}" class="action-link action-link-view">
                            Return to student profile
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
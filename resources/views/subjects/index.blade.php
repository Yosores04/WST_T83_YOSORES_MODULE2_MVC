<x-app-layout>
    <x-slot name="title">
        Subjects
    </x-slot>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subjects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card-custom">
                <div class="card-body-custom">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="text-2xl font-bold">Subjects List</h2>
                        
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('subjects.create') }}" 
                               class="btn-primary-custom">
                                Add New Subject
                            </a>
                        @endif
                    </div>

                    @if(session('success'))
                        <div class="alert-success-custom" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <!-- Search and Filter Form -->
                    <form action="{{ route('subjects.index') }}" method="GET" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="search" class="form-label-custom">Search</label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                       class="form-control-custom"
                                       placeholder="Code or Name">
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
                                
                                <a href="{{ route('subjects.index') }}" class="btn-secondary-custom">
                                    Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Subjects Table -->
                    <div class="table-responsive">
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Year Level</th>
                                    <th>Units</th>
                                    <th>Semester</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subjects as $subject)
                                    <tr>
                                        <td>{{ $subject->code }}</td>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $subject->department }}</td>
                                        <td>{{ $subject->year_level }}</td>
                                        <td>{{ $subject->units }}</td>
                                        <td>{{ $subject->semester }}</td>
                                        <td>
                                            <a href="{{ route('subjects.show', $subject) }}" class="action-link action-link-view">
                                                View
                                            </a>
                                            
                                            @if(auth()->user()->isAdmin())
                                                <a href="{{ route('subjects.edit', $subject) }}" class="action-link action-link-edit">
                                                    Edit
                                                </a>
                                                
                                                <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="action-link action-link-delete border-0 bg-transparent p-0"
                                                            onclick="return confirm('Are you sure you want to delete this subject?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-gray-500">
                                            No subjects found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $subjects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
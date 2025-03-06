<x-app-layout>
    <x-slot name="title">
        Edit Profile - {{ $student->user->name }}
    </x-slot>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Profile
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card-custom">
                <div class="card-body-custom">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="text-2xl font-bold">Edit Profile Information</h2>
                        <a href="{{ route('students.show', $student) }}" 
                           class="btn-secondary-custom">
                            Back to Profile
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert-success-custom" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('students.update', $student) }}" method="POST" class="mt-4">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-3">
                            <!-- Personal Information Section -->
                            <div class="col-12">
                                <h3 class="h5 fw-bold mb-3">Personal Information</h3>
                            </div>
                            
                            <!-- Name Field -->
                            <div class="col-md-6">
                                <label for="name" class="form-label-custom">Name</label>
                                <input type="text" name="name" id="name" 
                                       class="form-control-custom @error('name') is-invalid @enderror"
                                       value="{{ old('name', $student->user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Email Field -->
                            <div class="col-md-6">
                                <label for="email" class="form-label-custom">Email</label>
                                <input type="email" name="email" id="email" 
                                       class="form-control-custom @error('email') is-invalid @enderror"
                                       value="{{ old('email', $student->user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Address Field -->
                            <div class="col-12">
                                <label for="address" class="form-label-custom">Address</label>
                                <textarea name="address" id="address" rows="3" 
                                          class="form-control-custom @error('address') is-invalid @enderror">{{ old('address', $student->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Birthdate Field -->
                            <div class="col-md-6">
                                <label for="birthdate" class="form-label-custom">Birthdate</label>
                                <input type="date" name="birthdate" id="birthdate" 
                                       class="form-control-custom @error('birthdate') is-invalid @enderror"
                                       value="{{ old('birthdate', $student->birthdate ? $student->birthdate->format('Y-m-d') : '') }}">
                                @error('birthdate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Contact Number Field -->
                            <div class="col-md-6">
                                <label for="contact_number" class="form-label-custom">Contact Number</label>
                                <input type="text" name="contact_number" id="contact_number" 
                                       class="form-control-custom @error('contact_number') is-invalid @enderror"
                                       value="{{ old('contact_number', $student->contact_number) }}">
                                @error('contact_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Academic Information Section -->
                            <div class="col-12 mt-4">
                                <h3 class="h5 fw-bold mb-3">
                                    Academic Information 
                                    @if(!auth()->user()->isAdmin())
                                        (Non-editable)
                                    @endif
                                </h3>
                            </div>
                            
                            <!-- Student Number Field -->
                            <div class="col-md-4">
                                <label for="student_number" class="form-label-custom">Student Number</label>
                                @if(auth()->user()->isAdmin())
                                    <input type="text" name="student_number" id="student_number" 
                                           class="form-control-custom @error('student_number') is-invalid @enderror"
                                           value="{{ old('student_number', $student->student_number) }}">
                                    @error('student_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    <input type="text" id="student_number" 
                                           class="form-control-custom bg-light"
                                           value="{{ $student->student_number }}" readonly>
                                @endif
                            </div>
                            
                            <!-- Department Field -->
                            <div class="col-md-4">
                                <label for="department" class="form-label-custom">Department</label>
                                @if(auth()->user()->isAdmin())
                                    <input type="text" name="department" id="department" 
                                           class="form-control-custom @error('department') is-invalid @enderror"
                                           value="{{ old('department', $student->department) }}">
                                    @error('department')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    <input type="text" id="department" 
                                           class="form-control-custom bg-light"
                                           value="{{ $student->department }}" readonly>
                                @endif
                            </div>
                            
                            <!-- Year Level Field -->
                            <div class="col-md-4">
                                <label for="year_level" class="form-label-custom">Year Level</label>
                                @if(auth()->user()->isAdmin())
                                    <select name="year_level" id="year_level" 
                                            class="form-control-custom @error('year_level') is-invalid @enderror">
                                        <option value="1" {{ old('year_level', $student->year_level) == '1' ? 'selected' : '' }}>1st Year</option>
                                        <option value="2" {{ old('year_level', $student->year_level) == '2' ? 'selected' : '' }}>2nd Year</option>
                                        <option value="3" {{ old('year_level', $student->year_level) == '3' ? 'selected' : '' }}>3rd Year</option>
                                        <option value="4" {{ old('year_level', $student->year_level) == '4' ? 'selected' : '' }}>4th Year</option>
                                        <option value="5" {{ old('year_level', $student->year_level) == '5' ? 'selected' : '' }}>5th Year</option>
                                    </select>
                                    @error('year_level')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    <input type="text" id="year_level" 
                                           class="form-control-custom bg-light"
                                           value="{{ $student->year_level }}" readonly>
                                @endif
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn-primary-custom">
                                    Update Profile
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
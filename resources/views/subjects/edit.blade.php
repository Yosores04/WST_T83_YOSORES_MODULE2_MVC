<x-app-layout>
    <x-slot name="title">
        Edit Subject - {{ $subject->code }}
    </x-slot>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Subject
        </h2>
    </x-slot>
    
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Edit Subject</h2>
                <a href="{{ route('subjects.index') }}" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>

            <form action="{{ route('subjects.update', $subject) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="code" class="block text-gray-700 text-sm font-bold mb-2">
                        Subject Code
                    </label>
                    <input type="text" 
                           id="code" 
                           value="{{ $subject->code }}" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100"
                           disabled>
                    <p class="text-gray-500 text-xs italic mt-1">Subject code cannot be changed</p>
                </div>
                
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                        Subject Name *
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $subject->name) }}" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           required>
                    
                    @error('name')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="department" class="block text-gray-700 text-sm font-bold mb-2">
                        Department *
                    </label>
                    <select name="department" 
                            id="department" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                        <option value="">Select Department</option>
                        <option value="IT" {{ old('department', $subject->department) == 'IT' ? 'selected' : '' }}>IT</option>
                        <option value="EMC" {{ old('department', $subject->department) == 'EMC' ? 'selected' : '' }}>EMC</option>
                    </select>
                    
                    @error('department')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="year_level" class="block text-gray-700 text-sm font-bold mb-2">
                        Year Level *
                    </label>
                    <select name="year_level" 
                            id="year_level" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                        <option value="">Select Year Level</option>
                        <option value="1" {{ old('year_level', $subject->year_level) == '1' ? 'selected' : '' }}>1st Year</option>
                        <option value="2" {{ old('year_level', $subject->year_level) == '2' ? 'selected' : '' }}>2nd Year</option>
                        <option value="3" {{ old('year_level', $subject->year_level) == '3' ? 'selected' : '' }}>3rd Year</option>
                        <option value="4" {{ old('year_level', $subject->year_level) == '4' ? 'selected' : '' }}>4th Year</option>
                    </select>
                    
                    @error('year_level')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="semester" class="block text-gray-700 text-sm font-bold mb-2">
                        Semester *
                    </label>
                    <select name="semester" 
                            id="semester" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                        <option value="">Select Semester</option>
                        <option value="1" {{ old('semester', $subject->semester) == '1' ? 'selected' : '' }}>1st Semester</option>
                        <option value="2" {{ old('semester', $subject->semester) == '2' ? 'selected' : '' }}>2nd Semester</option>
                    </select>
                    
                    @error('semester')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
                        Description
                    </label>
                    <textarea name="description" 
                              id="description" 
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                              rows="4">{{ old('description', $subject->description) }}</textarea>
                    
                    @error('description')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Update Subject
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout> 
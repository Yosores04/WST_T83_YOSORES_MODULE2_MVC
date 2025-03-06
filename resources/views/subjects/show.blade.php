<x-app-layout>
    <x-slot name="title">
        Subject - {{ $subject->code }}
    </x-slot>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Subject Details
        </h2>
    </x-slot>
    
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Subject Details</h2>
                <a href="{{ route('subjects.index') }}" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-gray-100 p-6 rounded-lg mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Subject Information</h3>
                        <div class="mb-4">
                            <p class="text-gray-600">Subject Code</p>
                            <p class="font-semibold">{{ $subject->code }}</p>
                        </div>
                        <div class="mb-4">
                            <p class="text-gray-600">Name</p>
                            <p class="font-semibold">{{ $subject->name }}</p>
                        </div>
                        <div class="mb-4">
                            <p class="text-gray-600">Units</p>
                            <p class="font-semibold">{{ $subject->units }}</p>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Academic Information</h3>
                        <div class="mb-4">
                            <p class="text-gray-600">Department</p>
                            <p class="font-semibold">{{ $subject->department }}</p>
                        </div>
                        <div class="mb-4">
                            <p class="text-gray-600">Year Level</p>
                            <p class="font-semibold">{{ $subject->year_level }}</p>
                        </div>
                        <div class="mb-4">
                            <p class="text-gray-600">Semester</p>
                            <p class="font-semibold">{{ $subject->semester }}</p>
                        </div>
                    </div>
                </div>
                
                @if($subject->description)
                <div class="mt-4">
                    <h3 class="text-lg font-semibold mb-2">Description</h3>
                    <p>{{ $subject->description }}</p>
                </div>
                @endif
            </div>

            @if(auth()->user()->isAdmin())
            <div class="flex space-x-4 mb-6">
                <a href="{{ route('subjects.edit', $subject) }}" 
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit Subject
                </a>
                
                <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                            onclick="return confirm('Are you sure you want to delete this subject?')">
                        Delete Subject
                    </button>
                </form>
            </div>
            @endif

            @if(isset($subject->students) && method_exists($subject, 'students'))
                <div class="mt-4">
                    <h3 class="text-lg font-medium">Enrolled Students</h3>
                    
                    @if($subject->students->count() > 0)
                        <div class="overflow-x-auto mt-2">
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Student Number
                                        </th>
                                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Grade
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subject->students as $student)
                                        <tr>
                                            <td class="py-2 px-4 border-b border-gray-200">
                                                {{ $student->user->name }}
                                            </td>
                                            <td class="py-2 px-4 border-b border-gray-200">
                                                {{ $student->student_number }}
                                            </td>
                                            <td class="py-2 px-4 border-b border-gray-200">
                                                {{ $student->pivot->grade ?? 'Not graded' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="mt-2">No students enrolled in this subject.</p>
                    @endif
                </div>
            @else
                <div class="mt-4">
                    <h3 class="text-lg font-medium">Enrolled Students</h3>
                    <p class="mt-2">Student enrollment information is not available.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout> 
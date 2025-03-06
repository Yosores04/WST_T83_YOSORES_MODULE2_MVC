<x-app-layout>
    <x-slot name="title">
        Dashboard
    </x-slot>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    @if(auth()->user()->role === 'admin')
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Admin Dashboard</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg shadow-md border border-blue-200 hover:shadow-lg transition-shadow duration-300">
                                <h4 class="text-xl font-semibold text-blue-700 mb-3">Students</h4>
                                <p class="text-gray-700 mb-4">Manage student records and enrollments.</p>
                                <a href="{{ route('students.index') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300">View All Students →</a>
                            </div>
                            
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg shadow-md border border-blue-200 hover:shadow-lg transition-shadow duration-300">
                                <h4 class="text-xl font-semibold text-blue-700 mb-3">Subjects</h4>
                                <p class="text-gray-700 mb-4">Manage course subjects and schedules.</p>
                                <a href="{{ route('subjects.index') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300">View All Subjects →</a>
                            </div>
                        </div>
                    @else
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Student Dashboard</h3>
                        
                        @if(auth()->user()->student)
                            <div class="mb-8">
                                <h4 class="text-xl font-semibold text-blue-700 mb-4">Your Information</h4>
                                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg shadow-md border border-blue-200">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <p class="text-gray-600 text-sm mb-1">Student Number</p>
                                            <p class="text-gray-900 font-medium">{{ auth()->user()->student->student_number }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600 text-sm mb-1">Department</p>
                                            <p class="text-gray-900 font-medium">{{ auth()->user()->student->department }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600 text-sm mb-1">Year Level</p>
                                            <p class="text-gray-900 font-medium">{{ auth()->user()->student->year_level }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600 text-sm mb-1">Semester</p>
                                            <p class="text-gray-900 font-medium">{{ auth()->user()->student->semester }}</p>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ route('students.show', auth()->user()->student->id) }}" class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300">View Your Profile →</a>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <h4 class="text-xl font-semibold text-blue-700 mb-4">Your Enrolled Subjects</h4>
                                @if(auth()->user()->student->subjects->count() > 0)
                                    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
                                        <table class="min-w-full">
                                            <thead>
                                                <tr class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                                                    <th class="py-3 px-6 text-left text-sm font-medium uppercase tracking-wider">Code</th>
                                                    <th class="py-3 px-6 text-left text-sm font-medium uppercase tracking-wider">Name</th>
                                                    <th class="py-3 px-6 text-left text-sm font-medium uppercase tracking-wider">Units</th>
                                                    <th class="py-3 px-6 text-left text-sm font-medium uppercase tracking-wider">Schedule</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                @foreach(auth()->user()->student->subjects as $subject)
                                                    <tr class="hover:bg-blue-50 transition-colors duration-150">
                                                        <td class="py-4 px-6 text-sm font-medium text-gray-900">{{ $subject->code }}</td>
                                                        <td class="py-4 px-6 text-sm text-gray-700">{{ $subject->name }}</td>
                                                        <td class="py-4 px-6 text-sm text-gray-700">{{ $subject->units }}</td>
                                                        <td class="py-4 px-6 text-sm text-gray-700">{{ $subject->schedule }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-yellow-700">
                                                    You are not enrolled in any subjects yet.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-md">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-red-700">
                                            Student information not found. Please contact an administrator.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

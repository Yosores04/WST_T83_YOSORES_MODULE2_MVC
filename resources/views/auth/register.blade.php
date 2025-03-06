<x-guest-layout>
    <div class="card-custom shadow-lg rounded-lg overflow-hidden">
        <div class="card-body-custom p-8">
            <div class="flex justify-center mb-6">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </div>
            
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Register</h2>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" class="text-gray-700 font-medium" />
                    <x-text-input id="name" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Student Number -->
                <div class="mb-4">
                    <x-input-label for="student_number" :value="__('Student Number')" class="text-gray-700 font-medium" />
                    <x-text-input id="student_number" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="text" name="student_number" :value="old('student_number')" required />
                    <x-input-error :messages="$errors->get('student_number')" class="mt-2" />
                </div>

                <!-- Department -->
                <div class="mb-4">
                    <x-input-label for="department" :value="__('Department')" class="text-gray-700 font-medium" />
                    <select id="department" name="department" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="IT" {{ old('department') == 'IT' ? 'selected' : '' }}>Information Technology</option>
                        <option value="CS" {{ old('department') == 'CS' ? 'selected' : '' }}>Computer Science</option>
                        <option value="IS" {{ old('department') == 'IS' ? 'selected' : '' }}>Information Systems</option>
                    </select>
                    <x-input-error :messages="$errors->get('department')" class="mt-2" />
                </div>

                <!-- Year Level -->
                <div class="mb-4">
                    <x-input-label for="year_level" :value="__('Year Level')" class="text-gray-700 font-medium" />
                    <select id="year_level" name="year_level" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="1" {{ old('year_level') == '1' ? 'selected' : '' }}>1st Year</option>
                        <option value="2" {{ old('year_level') == '2' ? 'selected' : '' }}>2nd Year</option>
                        <option value="3" {{ old('year_level') == '3' ? 'selected' : '' }}>3rd Year</option>
                        <option value="4" {{ old('year_level') == '4' ? 'selected' : '' }}>4th Year</option>
                        <option value="5" {{ old('year_level') == '5' ? 'selected' : '' }}>5th Year</option>
                    </select>
                    <x-input-error :messages="$errors->get('year_level')" class="mt-2" />
                </div>

                <!-- Semester -->
                <div class="mb-4">
                    <x-input-label for="semester" :value="__('Semester')" class="text-gray-700 font-medium" />
                    <select id="semester" name="semester" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="1st" {{ old('semester') == '1st' ? 'selected' : '' }}>1st Semester</option>
                        <option value="2nd" {{ old('semester') == '2nd' ? 'selected' : '' }}>2nd Semester</option>
                        <option value="Summer" {{ old('semester') == 'Summer' ? 'selected' : '' }}>Summer</option>
                    </select>
                    <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                    <x-text-input id="password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-medium" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mb-4">
                    <a class="text-sm text-blue-600 hover:text-blue-800 underline" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow" style="background-color: #2563eb;">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

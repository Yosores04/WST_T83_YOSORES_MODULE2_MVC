<x-app-layout>
    <x-slot name="title">
        Pending Verification
    </x-slot>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account Status') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    Your account is pending verification by an administrator.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <h2 class="text-2xl font-bold mb-4">Pending Verification</h2>
                    
                    <p class="mb-4">
                        Thank you for registering with our Student Management System. Your account has been created successfully, but it needs to be verified by an administrator before you can access all features.
                    </p>
                    
                    <p class="mb-4">
                        Once your account is verified:
                    </p>
                    
                    <ul class="list-disc pl-5 mb-6 space-y-2">
                        <li>You'll be able to view your student profile</li>
                        <li>You can see your enrolled subjects</li>
                        <li>You can check your grades</li>
                    </ul>
                    
                    <p class="text-gray-600">
                        Please check back later or contact the administrator if you have any questions.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
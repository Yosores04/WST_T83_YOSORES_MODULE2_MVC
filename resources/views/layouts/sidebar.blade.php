<nav class="p-4">
    <div class="space-y-4">
        <a href="{{ route('dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-100">
            Dashboard
        </a>

        @if (auth()->user()->isAdmin())
            <a href="{{ route('students.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-100">
                Students
            </a>
            <a href="{{ route('students.verification') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-100">
                Verify Students
            </a>
        @endif

        <a href="{{ route('subjects.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-100">
            Subjects
        </a>

        @if (auth()->user()->isStudent() && auth()->user()->student)
            <a href="{{ route('students.show', auth()->user()->student->id) }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-100">
                My Profile
            </a>
        @endif
    </div>
</nav> 
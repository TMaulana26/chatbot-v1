<div x-data="{ isOpen: false }"
    class="fixed top-0 left-0 h-screen bg-gray-800 text-gray-100 shadow-md z-50 transition-all duration-300"
    :class="{ 'w-20': !isOpen, 'w-72': isOpen }">
    <div class="flex items-center justify-between px-4 py-3">
        <span class="text-xl font-semibold" x-show="isOpen">
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <x-sidebar-logo class="block h-14 w-auto" />
                </a>
            </div>
        </span>
        <div class="-me-2 flex items-center">
            <button @click="isOpen = !isOpen"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': isOpen, 'inline-flex': !isOpen }" class="inline-flex"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !isOpen, 'inline-flex': isOpen }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div class="flex flex-col items-center p-4 border-b border-gray-700" x-show="isOpen">
        <span class="mt-2 font-medium">{{ Auth::user()->name }}</span>
        <span class="text-sm text-gray-400">{{ Auth::user()->email }}</span>
        <x-nav-link class="mt-2" href="{{ route('profile.show') }}">
            {{ __('Profile') }}
        </x-nav-link>
    </div>

    <nav class="flex-1 mt-4">
        <div class="px-4 py-2">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                <i class="fas fa-tachometer-alt"></i>
                <span class="ml-3" x-show="isOpen">Dashboard</span>
            </x-responsive-nav-link>
        </div>
        <div class="px-4 py-2">
            <x-responsive-nav-link href="{{ route('users-management.index') }}" :active="request()->routeIs('users-management.index')">
                <i class="fas fa-users"></i>
                <span class="ml-3" x-show="isOpen">Users Management</span>
            </x-responsive-nav-link>
        </div>
        <div class="px-4 py-2">
            <x-responsive-nav-link href="{{ route('info-umum-h-r.index') }}" :active="request()->routeIs('info-umum-h-r.index')">
                <i class="fas fa-info-circle"></i>
                <span class="ml-3" x-show="isOpen">General Info HR</span>
            </x-responsive-nav-link>
        </div>
        <div class="px-4 py-2">
            <x-responsive-nav-link href="{{ route('system-instruction.index') }}" :active="request()->routeIs('system-instruction.index')">
                <i class="fas fa-book"></i>
                <span class="ml-3" x-show="isOpen">System Instruction</span>
            </x-responsive-nav-link>
        </div>
        <div class="px-4 py-2">
            <x-responsive-nav-link href="{{ route('department-management.index') }}" :active="request()->routeIs('department-management.index')">
                <i class="fas fa-sitemap"></i>
                <span class="ml-3" x-show="isOpen">Departments</span>
            </x-responsive-nav-link>
        </div>
        <div class="px-4 py-2">
            <x-responsive-nav-link href="{{ route('department-tasks-management.index') }}" :active="request()->routeIs('department-tasks-management.index')">
                <i class="fas fa-tasks"></i>
                <span class="ml-3" x-show="isOpen">Departments Tasks</span>
            </x-responsive-nav-link>
        </div>
        <div class="px-4 py-2">
            <x-responsive-nav-link href="{{ route('employees-management.index') }}" :active="request()->routeIs('employees-management.index')">
                <i class="fas fa-user-tie"></i>
                <span class="ml-3" x-show="isOpen">Employees Management</span>
            </x-responsive-nav-link>
        </div>
        <div class="px-4 py-2">
            <x-responsive-nav-link href="{{ route('attendance-management.index') }}" :active="request()->routeIs('attendance-management.index')">
                <i class="fas fa-calendar-check"></i>
                <span class="ml-3" x-show="isOpen">Employees Attendance</span>
            </x-responsive-nav-link>
        </div>
        <div class="px-4 py-2">
            <x-responsive-nav-link href="{{ route('leave-management.index') }}" :active="request()->routeIs('leave-management.index')">
                <i class="fas fa-plane-departure"></i>
                <span class="ml-3" x-show="isOpen">Leave Management</span>
            </x-responsive-nav-link>
        </div>
        <div class="px-4 py-2">
            <x-responsive-nav-link href="{{ route('chatbot-2') }}" :active="request()->routeIs('chatbot-2')">
                <i class="fas fa-robot"></i>
                <span class="ml-3" x-show="isOpen">Chabot Gemini</span>
            </x-responsive-nav-link>
        </div>
        <div class="px-4 py-2">
            <x-responsive-nav-link href="{{ route('chatbot') }}" :active="request()->routeIs('chatbot')">
                <i class="fas fa-robot"></i>
                <span class="ml-3" x-show="isOpen">Chabot GPT</span>
            </x-responsive-nav-link>
        </div>
    </nav>
    <div class="flex flex-col items-center p-4 border-t border-gray-700" x-show="isOpen">
        <form method="POST" action="{{ route('logout') }}" x-data>
            @csrf

            <x-button class="mt-2" href="{{ route('logout') }}" @click.prevent="$root.submit();">
                {{ __('Log Out') }}
            </x-button>
        </form>
    </div>
</div>

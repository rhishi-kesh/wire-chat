<x-app-layout>
    <x-slot name="header">
        <h2 class="mb-3 text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
        <div class="flex justify-start gap-5">
            <b>Users:</b>
            @foreach ($users as $user)
                <a href="{{ route('dashboard.chat', $user->id) }}" class="hover:text-blue-500">{{ $user->name }}</a>
            @endforeach
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

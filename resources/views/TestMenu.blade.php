<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Test::layout --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach ($menus as $menu)
                    <ul>
                        <li>{{ $menu->name }}</li>
                    </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
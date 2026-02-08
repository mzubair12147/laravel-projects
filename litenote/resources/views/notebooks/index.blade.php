<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- The -- here are used for translatons. Okay --}}
            Notes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col">
            <x-link-button class="self-end" href="{{ route('notebooks.create') }}">
                + New Notebook
            </x-link-button>

            @forelse($notebooks as $notebook)
                <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl hover:underline hover:underline-offset-1 text-indigo-600">
                        <a href="{{route('notebooks.show', $notebook)}}" >
                            {{ $notebook->name }}
                        </a>
                    </h2>
                </div>
            @empty
                <p class="text-center">You have no notebooks yet</p>
            @endforelse
        </div>
    </div>
</x-app-layout>

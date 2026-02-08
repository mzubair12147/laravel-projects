<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- The -- here are used for translatons. Okay --}}
            {{ request()->routeIs("notes.index") ? "Notes" : "Trashed" }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col">
            <x-flash-message>{{session("success")}}</x-flash-message>

            @if(request()->routeIs("notes.index"))
                <x-link-button class="self-end" href="{{ route('notes.create') }}">
                    + New Note
                </x-link-button>
            @endif

            @forelse($notes as $note)
                <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl hover:underline hover:underline-offset-1 text-indigo-600">
                        <a href="{{request()->routeIs('notes.show') ? route('notes.show', $note) : route('trashed.show', $note)}}">
                            {{ $note->title }}
                        </a>
                    </h2>
                    <p class="mt-4 space-y-6 whitespace-pre-wrap">{{ $note->text }}</p>
                </div>
            @empty
                <p class="text-center">You have no notes yet</p>
            @endforelse
        </div>
    </div>
</x-app-layout>

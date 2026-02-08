<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- The -- here are used for translatons. Okay --}}
            {{!$note->trashed() ? "Notes" : "Trash"}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-flash-message>{{session("success")}}</x-flash-message>
            <div class="flex justify-between items-center">
                <div class="flex space-x-6">
                    @if($note->notebook)
                        <p class="opacity-70"><strong>Notebook: </strong>
                            {{$note->notebook->name}}
                        </p>
                    @endif
                    <p class="opacity-70"><strong>Created: </strong>
                        {{$note->created_at->diffForHumans()}}
                    </p>

                    <p class="opacity-70"><strong>Last Changed: </strong>
                        {{$note->updated_at->diffForHumans()}}
                    </p>

                </div>
                <div class="flex gap-6">
                    @if(request()->routeIs("notes.show"))
                        <x-link-button href="{{ route('notes.edit', $note) }}">Edit Note</x-link-button>
                        <form method="post" action="{{route('notes.destroy', $note)}}">
                            @method("DELETE")
                            @csrf
                            <x-primary-button class="bg-red-500 hover:bg-red-600 focus:bg-red-600"
                                              onclick="return confirm('are you sure you want to delete this note')">
                                Delete
                                Button
                            </x-primary-button>
                        </form>
                    @else
                        <form method="post" action="{{route('trashed.update', $note)}}">
                            @method("put")
                            @csrf
                            <x-primary-button>Restore Note
                            </x-primary-button>
                        </form>

                        <form method="post" action="{{route('trashed.destroy', $note)}}"
                            onclick="return confirm('Do you really want to delete this model?')"
                        >
                            @method("delete")
                            @csrf
                            <x-primary-button>Delete Note Permanently
                            </x-primary-button>
                        </form>

                    @endif
                </div>
            </div>
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl text-indigo-600">
                    {{ $note->title }}
                </h2>
                <p class="mt-2 space-y-6">{{ Str::limit($note->text, 100, '...') }}</p>
                <span class="block mt-4 text-sm opacity-70">{{ $note->updated_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- The -- here are used for translatons. Okay --}}
            Notebooks
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg  max-w-3xl">
                <form method="post" class="" action="{{ route('notebooks.store') }}">
                    {{-- If you don't have the @scrf directive then you will get a 419 page expired error --}}
                    @csrf
                    <x-text-input name="name" class="w-full" placeholder="Notebook name"
                                  value="{{old('name')}}"></x-text-input>
                    @error('name')
                    <div class="text-sm mt-1 text-red-500">
                        {{$message}}
                    </div>
                    @enderror

                    <x-primary-button class="mt-6">Save Notebook</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

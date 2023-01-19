<x-app-layout>
    <x-slot name="title">{{ __('anime.genre.title') }}</x-slot>

    <div class="flex flex-col items-center justify-between gap-8 pb-4 md:flex-row">
        <div class="flex flex-col items-center">
            <x-title>{{ __('anime.genre.title') }}</x-title>
        </div>
    </div>
    <div class="grid items-start justify-center grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-4">
        @foreach ($genres as $genre)
        <x-button-link href="{{ route('anime.genre.show', str_replace(' ', '-', strtolower($genre->name))) }}">
            <x-slot name="icon">
                <i class="fa-solid fa-chevron-right text-lg"></i>
            </x-slot>

            <p class="text-lg font-semibold font-primary md:text-xl">{{ $genre->name }}</p>
        </x-button-link>
        @endforeach
    </div>
</x-app-layout>

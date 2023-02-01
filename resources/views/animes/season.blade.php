<x-app-layout>
    <x-slot name="title">{{ __('anime.season.title') }} {{ ucfirst($seasons['current']['season']) . ' ' . $seasons['current']['year'] }}</x-slot>
    <x-slot name="meta_description">{{ __('meta.season.description', ['season' => $seasons['current']['season'] . ' ' . $seasons['current']['year']]) }}</x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
        <div class=""></div>
        <div class="flex flex-row items-center justify-between md:justify-center gap-8 font-primary">
            @if (!is_null($seasons['previous']))
            <a href="{{ route('anime.season', ['year' => $seasons['previous']['year'], 'season' => $seasons['previous']['season']]) }}" class="flex text-link dark:text-emerald-200">
                <i class="fa-solid fa-arrow-left text-xl"></i>
            </a>
            <a href="{{ route('anime.season', ['year' => $seasons['previous']['year'], 'season' => $seasons['previous']['season']]) }}" class="flex flex-col items-center text-link dark:text-emerald-200">
                <p class="text-xl">{{ ucfirst($seasons['previous']['season']) }}</p>
                <p class="text-sm">{{ $seasons['previous']['year'] }}</p>
            </a>
            @endif

            <div class="flex flex-col items-center font-bold text-emerald-700 dark:text-emerald-300">
                <p class="text-3xl">{{ ucfirst($seasons['current']['season']) }}</p>
                <p class="text-lg">{{ $seasons['current']['year'] }}</p>
            </div>

            @if (!is_null($seasons['next']))
            <a href="{{ route('anime.season', ['year' => $seasons['next']['year'], 'season' => $seasons['next']['season']]) }}" class="flex flex-col items-center text-link dark:text-emerald-200">
                <p class="text-xl">{{ ucfirst($seasons['next']['season']) }}</p>
                <p class="text-sm">{{ $seasons['next']['year'] }}</p>
            </a>
            <a href="{{ route('anime.season', ['year' => $seasons['next']['year'], 'season' => $seasons['next']['season']]) }}" class="flex text-link dark:text-emerald-200">
                <i class="fa-solid fa-arrow-right text-xl"></i>
            </a>
            @endif
        </div>
        <div x-data="{}" class="flex flex-row-reverse items-center">
            <div class="flex flex-row gap-3 items-center">
                <span>Bahasa Judul:</span>
                <select x-model="$store.titleLanguage" x-on:change="changeTitleLanguage($event.target.value)" class="h-10 px-4 text-lg rounded-md bg-emerald-100 dark:bg-gray-800 focus:outline-none focus:ring focus:ring-emerald-300" name="" id="">
                    <option value="romaji">Romaji</option>
                    <option value="english">Inggris</option>
                    <option value="japanese">Kana</option>
                </select>
            </div>
        </div>
    </div>
    <div class="flex flex-col gap-8 divide-y divide-gray-400 divide-dashed divide-opacity-50">
        <x-anime-list class="gap-2">

            @forelse ($animes->where('members', '>=', config('anime.season.min_members')) as $anime)
            <x-anime-card :anime="$anime" :resources="$resources[$anime['mal_id']]" />
            @empty
            <div class="text-lg italic">
                {{ __('anime.season.no_anime') }}
            </div>
            @endforelse

        </x-anime-list>
    </div>
</x-app-layout>

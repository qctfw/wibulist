<x-app-layout>
    <x-slot name="title">{{ __('anime.genre.title') }} / {{ $genre->name }}{{ ($page > 1) ? ' (Hal. ' . $page . ')' : '' }}</x-slot>
    <x-slot name="meta_title">{{ __('anime.genre.title') }} / {{ $genre->name }}</x-slot>

    <div class="flex flex-col items-center justify-between gap-8 pb-4 md:flex-row">
        <div class="flex flex-col items-center font-bold text-blue-700 dark:text-blue-300">
            <x-title>{{ __('anime.genre.title') }} / {{ $genre->name }}</x-title>
        </div>
        @if ($pagination['last_visible_page'] > 1) <x-pagination-link :current="$page" :total="$pagination['last_visible_page']" /> @endif
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
    <x-anime-list>
        @foreach ($animes as $anime)
            <x-anime-card :anime="$anime" :resources="$resources[$anime['mal_id']]" />
        @endforeach
    </x-anime-list>
    @if ($pagination['last_visible_page'] > 1)
    <div class="flex flex-col items-center justify-between gap-2 mt-4 md:flex-row">
        <div class="font-primary">Halaman {{ $page }} / {{ $pagination['last_visible_page'] }}</div>
        <x-pagination-link :current="$page" :total="$pagination['last_visible_page']" />
    </div>
    @endif
</x-app-layout>

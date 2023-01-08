<div class="relative flex flex-col py-1 mt-4 bg-gray-100 divide-y divide-gray-400 shadow divide-opacity-50 divide-dashed dark:bg-gray-800 rounded-xl">
    <div x-data="{ title: `{{ $anime['titles']['default'][0] }}` }" class="flex items-center justify-center h-12">
        <a
            href="{{ route('anime.show', $anime['mal_id']) }}"
            rel="nofollow"
            class="p-1 font-semibold leading-none text-center font-primary text-link dark:text-emerald-200"
            x-bind:class="title.length <= 50 ? 'text-lg lg:text-xl' : title.length <= 80 ? 'text-md lg:text-lg' : 'text-md'"
            x-text="title"></a>
    </div>
    <div class="flex flex-row flex-wrap flex-grow items-center justify-center gap-x-4 py-2 text-sm">
        <div class="flex flex-row gap-1 text-center">
            @forelse ($anime['studios'] as $studio)
                <a href="{{ route('anime.producer', ['id' => $studio['mal_id']]) }}" class="text-link text-link-underline">{{ $studio['name'] }}{{ (!$loop->last) ? ',' : '' }}</a>
            @empty
                <p>-</p>
            @endforelse
        </div>
        <span class="select-none">&bull;</span>

        <div class="text-center">{{ $anime['episodes'] ?? '?' }} ep @if (!empty($anime['type']) && !request()->routeIs('anime.season-current')){{ '(' . $anime['type'] . ')' }}@endif</div>
        <span class="select-none">&bull;</span>
        <div class="text-center">{{ $anime['source'] }}</div>
    </div>
    <div class="flex flex-row flex-wrap flex-grow items-center justify-center gap-2 px-1 py-2 text-xs">
        @forelse ($anime['genres'] as $genre)
        <a href="{{ route('anime.genre.show', str_replace(' ', '-', strtolower($genre['name']))) }}" class="h-4 px-2 transition-colors bg-gray-300 rounded-lg dark:bg-gray-700 hover:bg-emerald-300 dark:hover:bg-emerald-600">{{ $genre['name'] }}</a>
        @empty
        <span class="italic">Tidak ada genre</span>
        @endforelse
        @foreach ($anime['explicit_genres'] as $genre)
        <a href="{{ route('anime.genre.show', str_replace(' ', '-', strtolower($genre['name']))) }}" class="h-4 px-2 transition-colors bg-red-300 rounded-lg dark:bg-red-700 hover:bg-red-500 dark:hover:bg-red-600">{{ $genre['name'] }}</a>
        @endforeach
    </div>
    <div class="relative grid grid-cols-2 h-60 md:h-64 lg:h-80 xl:h-72">
        <a href="{{ route('anime.show', $anime['mal_id']) }}" rel="nofollow" class="relative w-full mx-auto h-60 md:h-64 lg:h-80 xl:h-72 anime-cover">
            <div class="flex flex-col items-center justify-center w-full h-72 spinner">
                <x-icons.spinner class="block w-5 h-5" />
            </div>
            <img alt="{{ $anime['titles']['default'][0] }} Anime Poster" data-src="{{ $anime['images']['webp']['image_url'] }}" class="absolute inset-x-0 top-0 max-w-full max-h-full mx-auto opacity-0" loading="lazy" />
            @if (filled($anime['explicit_genres']))
            <div x-data="{showCover: false}" x-on:click.prevent="showCover = true" x-show="!showCover" class="absolute inset-x-0 top-0 flex items-center justify-center w-full h-full text-gray-200 backdrop-blur">
                <div class="flex items-center px-2 py-1 bg-gray-800 rounded">Lihat</div>
            </div>
            @endif
        </a>
        @if (!blank($resources))
        <div class="absolute inset-x-0 -bottom-[1px] flex flex-row flex-wrap items-center justify-center w-1/2 h-auto gap-3 py-1 bg-gray-200 bg-opacity-80 dark:bg-gray-900 dark:bg-opacity-60">
            @foreach ($resources as $resource)
            <a href="{{ $resource->link }}" target="_blank" class="w-6 h-6" title="{{ $resource->alternative_note }}">
                <img src="{{ logo_asset($resource->platform->icon_path) }}" alt="{{ $resource->platform->name }} Logo" />
            </a>
            @endforeach
        </div>
        @endif
        <div class="pl-2 overflow-y-auto scrollbar-extra-thin scrollbar-thumb-gray-400 scrollbar-track-gray-300 dark:scrollbar-thumb-gray-500 dark:scrollbar-track-gray-700">
            <p class="text-sm leading-relaxed whitespace-pre-line">{{ $anime['synopsis'] }}</p>
        </div>
    </div>
    <div class="relative h-min flex flex-row items-center justify-between px-2 py-1 font-medium font-primary">
        @if (filled($anime['demographics']))
        <div class="flex flex-row items-center justify-center gap-2 text-center">
            <x-icons.user-group-solid class="w-5 h-5" />
            <a href="{{ route('anime.genre.show', str_replace(' ', '-', strtolower($anime['demographics'][0]['name']))) }}" class="text-link text-link-underline">{{ $anime['demographics'][0]['name'] }}</a>
        </div>
        @endif
        <div class="flex flex-row items-center justify-center gap-2 text-center">
            <x-icons.calendar-solid class="w-5 h-5" />
            @if (!is_null($anime['aired_from']))
            <span>{{ (count($anime['demographics']) > 0) ? $anime->airedFromLongFormat() : $anime->airedFromShortFormat() }}</span>
            @else
            <span>?</span>
            @endif
        </div>
        <div class="flex flex-row items-center justify-center gap-2 text-center">
            <x-icons.star-solid class="w-5 h-5" />
            <span>{{ $anime['score'] ?? 'T/A' }}</span>
        </div>
        <div class="flex flex-row items-center justify-center gap-2 text-center">
            <x-icons.user-solid class="w-5 h-5" />
            <span>{{ abbreviate_number($anime['members']) }}</span>
        </div>
    </div>
</div>

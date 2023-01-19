<x-app-layout>
    <x-slot name="title">{{ __('anime.producer.title') }} / {{ $producer['titles']['default']['title'] }}{{ ($page > 1) ? ' (Hal. ' . $page . ')' : '' }}</x-slot>
    <x-slot name="meta_title">{{ __('anime.producer.title') }} / {{ $producer['titles']['default']['title'] }}</x-slot>
    <x-slot name="meta_robots">noindex, nofollow</x-slot>

    <div class="flex flex-col gap-3">
        <div class="flex flex-col xl:flex-row items-start gap-3">
            <div class="xl:w-2/3">
                <div class="float-left mr-4 mb-2 lg:mr-8">
                    <div class="relative w-44 lg:w-56 anime-cover">
                        <div class="flex flex-col items-center justify-center w-full h-44 lg:h-48 spinner">
                            <i class="animate-spin fa-solid fa-spinner text-lg text-gray-800 dark:text-gray-100"></i>
                        </div>
                        <img data-src="{{ $producer['images']['jpg']['image_url'] }}" alt="{{ $producer['titles']['default']['title'] }}" class="absolute inset-x-0 top-0 max-w-full max-h-full mx-auto opacity-0" loading="lazy" />
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-left text-emerald-700 dark:text-emerald-300 font-primary lg:text-5xl">{{ $producer['titles']['default']['title'] }}</h2>
                    <p>{{ $producer['titles']['japanese']['title'] ?? '' }}</p>
                    <p class="mt-3 xl:pr-1">@if(!empty($producer['about'])) {!! nl2br(e($producer['about'])) !!} @else <i>{{ __('anime.producer.no_description') }}</i> @endif</p>
                </div>
            </div>
            <div class="flex flex-col gap-4 w-full xl:w-1/3">
                <div class="flex flex-row justify-between items-center gap-4 p-3 md:gap-10 bg-gray-100 rounded-xl dark:bg-gray-800 dark:bg-opacity-60">
                    <div class="flex flex-col text-center">
                        <p class="font-semibold font-primary text-xl">{{ __('anime.producer.established') }}</p>
                        <p>{{ $producer['established'] }}</p>
                    </div>
                    <div class="flex flex-col text-center">
                        <p class="font-semibold font-primary text-xl">{{ __('anime.producer.favorites') }}</p>
                        <p>{{ $producer['favorites'] }}</p>
                    </div>
                    <div class="flex flex-col text-center">
                        <p class="font-semibold font-primary text-xl">{{ __('anime.producer.count') }}</p>
                        <p>{{ $producer['count'] }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2 md:grid-cols-3 xl:grid-cols-2 p-3 bg-gray-100 rounded-xl dark:bg-gray-800 dark:bg-opacity-60">
                    <a href="{{ $producer['url'] }}" title="{{ $producer['titles']['default']['title'] }} MyAnimeList" target="_blank" class="flex flex-row items-center text-link text-link-underline gap-2">
                        <img src="{{ logo_asset('img/logos/myanimelist.webp') }}" class="w-6 h-6 lg:w-8 lg:h-8 rounded" />
                        <span>MyAnimeList</span>
                    </a>
                    @foreach ($producer['external'] as $site)
                        @php
                            $site_type = guess_site($site['url']);
                            $site_classes = in_array($site_type, ['twitter', 'instagram', 'youtube', 'facebook', 'twitch']) ?
                                'fa-brands fa-' . $site_type :
                                'fa-solid fa-globe';

                            $logo_str = sprintf(
                                '<a href="%s" title="%s" target="_blank" class="flex flex-row items-center text-link gap-2 h-6 lg:h-8"><i class="%s dark:text-white w-6 lg:w-8 pl-1 no-underline text-lg lg:text-2xl"></i><span class="text-link-underline">%s</span></a>',
                                $site['url'],
                                $producer['titles']['default']['title'] . ' ' . ucwords($site_type),
                                $site_classes,
                                $site['name']
                            );
                        @endphp
                        {!! \Blade::render($logo_str) !!}
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex flex-col items-center justify-between gap-8 pb-4 md:flex-row">
            <div class="hidden md:flex flex-col items-center font-bold text-blue-700 dark:text-blue-300">
                <x-title>Anime {{ $producer['titles']['default']['title']  }}</x-title>
            </div>
            @if ($pagination['last_visible_page'] > 1) <x-pagination-link :current="$page" :total="$pagination['last_visible_page']" /> @endif
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

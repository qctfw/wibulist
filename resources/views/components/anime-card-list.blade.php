<div class="relative flex flex-col items-center justify-between p-2 transition-colors bg-gray-100 text-green-900 rounded-lg group hover:bg-green-100 dark:hover:bg-green-800 md:static md:flex-row dark:bg-gray-800 dark:text-green-50 md:h-auto">
    @php
        $ranktext = 'text-lg md:text-xl';
        if ($anime['rank'] <= 10) {
            $ranktext = 'text-2xl md:text-3xl';
        }
        elseif ($anime['rank'] <= 100) {
            $ranktext = 'text-xl md:text-2xl';
        }
    @endphp
    <div class="absolute top-0 left-0 w-auto px-2 {{ $ranktext }} text-center bg-gray-200 rounded-lg md:bg-transparent md:static md:block md:flex-none md:w-12 md:px-0 dark:bg-gray-900 md:rounded-none md:font-bold">
        #{{ $anime['rank'] }}
    </div>
    <a href="{{ route('anime.show', $anime['mal_id']) }}" rel="nofollow" class="flex flex-row items-center w-full md:w-20 md:pl-4">
        <img src="{{ $anime['image_url'] }}" alt="'{{ $anime['title'] }}' Anime Poster" loading="lazy" class="mx-auto" />
    </a>
    <div class="grid items-center flex-auto w-full grid-cols-1 pb-2 border-b border-gray-400 border-opacity-50 border-dashed md:w-auto md:items-baseline md:flex md:flex-auto md:flex-col md:ml-3 md:border-none md:pb-0">
        <a href="{{ route('anime.show', $anime['mal_id']) }}" rel="nofollow" class="flex flex-row items-center justify-center py-2 text-link text-lg font-semibold font-primary text-center border-b border-gray-400 border-opacity-50 border-dashed md:text-left md:py-0 md:border-none">
            {{ $anime['title'] }}
        </a>
        <div class="flex flex-row items-center justify-center gap-0 pt-2 text-center md:gap-2 md:text-left text-md md:text-sm md:pt-0">
            <x-icons.video-camera-solid class="flex-none w-5 h-5" />
            <p class="flex-auto">{{ $anime['type'] }}{{ ($anime['episodes'] > 1) ? ' ('.$anime['episodes'].' ep)' : '' }}</p>
        </div>
        <div class="flex flex-row items-center justify-center gap-0 text-center md:gap-2 md:text-left text-md md:text-sm">
            <x-icons.calendar-solid class="flex-none w-5 h-5" />
            <p class="flex-auto">
                {{ $anime['start_date'] ?? '-' }}
                @if (!is_null($anime['end_date']) && $anime['start_date'] != $anime['end_date'])
                <span class="hidden md:inline"> - {{ $anime['end_date'] }}</span>
                @endif
            </p>
        </div>
        <div class="flex flex-row items-center justify-center gap-0 text-center md:gap-2 md:text-left text-md md:text-sm">
            <x-icons.user-solid class="w-5 h-5" />
            <p class="flex-auto">{{ $anime['members'] }}</p>
        </div>
    </div>
    @if (!blank($resources))
    <div class="flex-row items-center justify-center hidden gap-3 p-2 mx-4 text-sm text-center transition-colors bg-gray-300 rounded-lg dark:bg-gray-900 md:flex group-hover:bg-green-200 dark:group-hover:bg-green-900">
        @foreach ($resources as $resource)
        <a href="{{ $resource->link }}" target="_blank" class="w-6 h-6" title="{{ $resource->alternative_note }}">
            <img src="{{ logo_asset($resource->platform->icon_path) }}" alt="{{ $resource->platform->name }} Logo" />
        </a>
        @endforeach
    </div>
    @endif
    <div class="grid flex-none grid-cols-1 md:grid-cols-2">
        <div class="{{ ($anime['score'] == 'N/A') ? 'hidden md:flex' : 'flex'}} flex-row items-center justify-center pt-2 md:pt-0 md:col-span-2 md:mr-4">
            <x-icons.star-solid class="w-6 h-6 pr-1" />
            <span class="text-xl font-semibold">{{ $anime['score'] }}</span>
        </div>
        @if (!blank($resources))
        <div class="flex-row items-center justify-center mx-4 md:hidden">
            <div class="flex flex-row items-center justify-center gap-3 pt-2 text-sm text-center">
                @foreach ($resources as $resource)
                <img src="{{ logo_asset($resource->platform->icon_path) }}" alt="{{ $resource->platform->name }} Logo" class="w-6 h-6" />
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
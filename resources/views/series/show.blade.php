<x-casteaching-layout>
    <div class="flex flex-col items-center mt-10">
        <div class="flex w-full max-w-7xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Barra lateral amb vídeos -->
            <div class="w-1/4 bg-gray-50 p-6 border-r border-gray-200">
                <h2 class="text-gray-900 uppercase font-bold text-lg tracking-tight mb-4 flex items-center space-x-2">
                    <!-- SVG de vídeo de color roig -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M15 10.5V6c0-.825-.675-1.5-1.5-1.5h-9C3.675 4.5 3 5.175 3 6v12c0 .825.675 1.5 1.5 1.5h9c.825 0 1.5-.675 1.5-1.5v-4.5l6 6v-15l-6 6z"/>
                    </svg>
                    <span>{{ __('Serie:') }} {{ $series->title }}</span>
                </h2>
                <nav class="flex flex-col space-y-1">
                    @foreach($series->videos as $vid)
                        <a href="{{ route('series.show.video', ['seriesId' => $series->id, 'videoId' => $vid->id]) }}" class="{{ $video && $video->id === $vid->id ? 'text-red-600 bg-gray-100' : 'text-gray-700 hover:text-red-600 hover:bg-gray-50' }} rounded-md p-2 text-sm font-semibold">
                            {{ $vid->title }}
                        </a>
                    @endforeach
                </nav>
            </div>

            <!-- Contingut principal amb el vídeo i la informació -->
            <div class="flex-grow p-6 flex flex-col items-center">
                <!-- Video iframe -->
                @if ($iframe)
                    <div class="w-full mb-6">
                        {!! $iframe !!}
                    </div>
                @else
                    <div class="w-full mb-6 text-center text-gray-500 flex flex-col items-center">
                        <!-- SVG d'avís de perill -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-600 mb-2" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12 12-5.372 12-12S18.628 0 12 0zm0 22C6.486 22 2 17.514 2 12S6.486 2 12 2s10 4.486 10 10-4.486 10-10 10zm1-16h-2v8h2V6zm0 10h-2v2h2v-2z"/>
                        </svg>
                        {{ __('No hi han videos disponibles per aquesta serie.') }}
                    </div>
                @endif

                <!-- Video details -->
                @if ($video)
                    <div class="w-full bg-white rounded-lg shadow-lg px-6 py-6 border-t-2 border-red-600">
                        <h2 class="text-gray-900 uppercase font-bold text-2xl tracking-tight border-b border-gray-300 mb-4">
                            {{ $video->title }}
                        </h2>
                        <div class="prose-sm md:prose lg:prose-xl 2xl:prose-2xl">
                            {!! Str::markdown($video->description) !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-casteaching-layout>

<x-casteaching-layout>
    <div class="flex flex-col items-center mt-20">
        <div class="w-full max-w-7xl mx-auto bg-white rounded-lg shadow-lg p-6">
            {!! $iframe !!}
            <div class="mt-6 border-t-2 border-red-600">
                <h2 class="text-gray-900 uppercase font-bold text-2xl tracking-tight border-b border-gray-300 mb-4">
                    {{ $video->title }}
                </h2>
                <div class="prose max-w-none">
                    {!! Str::markdown($video->description) !!}
                </div>
            </div>
        </div>
    </div>
</x-casteaching-layout>

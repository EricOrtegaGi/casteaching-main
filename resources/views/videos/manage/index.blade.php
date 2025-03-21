<x-casteaching-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Videos') }}
        </h2>
    </x-slot>

    <div class="mx-auto sm:px-6 lg:px-8 w-full max-w-7xl">
        <x-status></x-status>
        @can('videos_manage_create')
            <div class="space-y-10 divide-y divide-gray-900/10 mt-10">
                <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
                    <div class="px-4 sm:px-0">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Vídeos</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Informació bàsica del vídeo</p>
                    </div>

                    <form data-qa="form_video_create" method="POST" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                        @csrf
                        <div class="px-4 py-6 sm:p-8">
                            <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="col-span-full">
                                    <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Títol</label>
                                    <div class="mt-2">
                                        <input id="title" name="title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6" placeholder="Títol del vídeo">
                                    </div>
                                </div>

                                <div class="col-span-full">
                                    <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Descripció</label>
                                    <div class="mt-2">
                                        <textarea id="description" name="description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6" placeholder="Description"></textarea>
                                    </div>
                                </div>

                                <div class="sm:col-span-4">
                                    <label for="url" class="block text-sm font-medium leading-6 text-gray-900">URL</label>
                                    <div class="mt-2">
                                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-red-600 sm:max-w-md">
                                            <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">http://</span>
                                            <input type="url" name="url" id="url" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="www.youtube.com">
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="serie" class="block text-sm font-medium leading-6 text-gray-900">Serie</label>
                                    <div class="mt-2">
                                        <select id="serie" name="serie_id" autocomplete="serie-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            @foreach(\App\Models\Serie::all() as $serie)
                                                <option value="{{ $serie->id }}">{{ $serie->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                            <x-button type="submit" class="rounded-md px-3 py-2 text-sm font-semibold">Crear</x-button>
                        </div>
                    </form>
                </div>
            </div>
        @endcan

        <div class="mt-10 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-6">Títol</th>
                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Descripció</th>
                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">URL</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-sm text-center">Accions
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($videos as $video)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-center font-medium text-gray-900 sm:pl-6">{{ $video->title }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $video->description }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $video->url }}</td>
                                    <td class="whitespace-nowrap py-3.5 pl-3 pr-4 sm:pr-6 text-right text-sm text-center font-medium">
                                        <div class="flex justify-end items-center space-x-3">
                                            <a href="/videos/{{ $video->id }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">Mostrar</a>
                                            <a href="/manage/videos/{{ $video->id }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Editar</a>
                                            <form class="inline" action="/manage/videos/{{ $video->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Esborrar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-casteaching-layout>

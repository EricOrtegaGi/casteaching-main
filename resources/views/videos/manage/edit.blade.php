<x-casteaching-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $video->title }}
        </x-slot>

    <div class="mx-auto sm:px-6 lg:px-8 w-full max-w-7xl">

        @can('videos_manage_create')
            <div class="p-4 mt-10">
            <form data-qa="form_video_edit" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-12">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                        <div>
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Vídeos</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Informació bàsica del vídeo</p>
                        </div>

                        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

                            <div class="col-span-full">
                                <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                                <div class="mt-2">
                                    <input id="title" name="title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6" value="{{ $video->title }}"></input>
                                </div>
                                <p class="mt-3 text-sm leading-6 text-gray-600">Títol curt del nostre vídeo</p>
                            </div>

                            <div class="col-span-full">
                                <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                                <div class="mt-2">
                                    <textarea id="description" name="description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">{{ $video->description }}"</textarea>
                                </div>
                                <p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences about yourself.</p>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="url" class="block text-sm font-medium leading-6 text-gray-900">URL</label>
                                <div class="mt-2">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-red-600 sm:max-w-md">
                                        <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">http://</span>
                                        <input type="url" name="url" id="url" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="{{ $video->url }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <x-button type="submit" class="rounded-md px-3 py-2 text-sm font-semibold">Editar</x-button>
                </div>
            </form>
        </div>
        @endcan

    </div>
</x-casteaching-layout>

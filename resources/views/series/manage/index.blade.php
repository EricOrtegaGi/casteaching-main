<x-casteaching-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Series') }}
        </h2>
    </x-slot>

    <div class="mx-auto sm:px-6 lg:px-8 w-full max-w-7xl">
        <x-status></x-status>

        @can('series_manage_create')
            <div class="space-y-10 divide-y divide-gray-900/10 mt-10">
                <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
                    <div class="px-4 sm:px-0">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Series</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Informació bàsica de les series</p>
                    </div>

                    <form method="POST" enctype="multipart/form-data" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                        @csrf
                        <div class="px-4 py-6 sm:p-8">
                            <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                                <div class="col-span-full">
                                    <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Títol</label>
                                    <div class="mt-2">
                                        <input id="title" name="title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6" placeholder="Title" required>
                                    </div>
                                </div>

                                <div class="col-span-full">
                                    <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                                    <div class="mt-2">
                                        <textarea id="description" name="description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6" placeholder="Description" required></textarea>
                                    </div>
                                </div>

                                <div class="col-span-full">
                                    <label for="teacher_name" class="block text-sm font-medium leading-6 text-gray-900">Nom del professor</label>
                                    <div class="mt-2">
                                        <input id="teacher_name" name="teacher_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6" placeholder="Nom del professor" required>
                                    </div>
                                </div>

                                <div class="col-span-full">
                                    <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Imatge</label>
                                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                        <div class="text-center">
                                            <img id="image-preview" class="mx-auto h-24 w-24 object-cover rounded-lg mb-4" style="display: none;" />
                                            <svg id="upload-icon" class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                            </svg>
                                            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                                <label for="image" class="relative cursor-pointer rounded-md bg-white font-semibold text-red-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-red-600 focus-within:ring-offset-2 hover:text-red-500">
                                                    <span>Penja una imatge</span>
                                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*" required onchange="previewImage(event)">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                                        </div>
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

        <div class="px-4 sm:px-6 lg:px-8 mt-10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Series</h1>
                    <p class="mt-2 text-sm text-gray-700">Llista de totes les serires disponibles</p>
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-6">Imatge</th>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-6">Títol</th>
                                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Descripció</th>
                                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Nom del Professor</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0"> Accions
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($series as $serie)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-center font-medium text-gray-900 sm:pl-6">
                                            <img src="{{ asset('storage/' . $serie->image) }}" alt="{{ $serie->title }}" class="w-16 h-16 object-cover rounded">
                                        </td>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-center font-medium text-gray-900 sm:pl-6">{{ $serie->title }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $serie->description }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-gray-500">{{ $serie->teacher_name }}</td>
                                        <td class="whitespace-nowrap py-3.5 pl-3 pr-4 sm:pr-6 text-center">
                                            <div class="flex justify-end items-center space-x-3">
                                                <a href="/series/{{ $serie->id }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">Mostrar</a>
                                                <a href="/manage/series/{{ $serie->id }}/edit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Editar</a>
                                                <form class="inline" action="/manage/series/{{ $serie->id }}" method="POST">
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
    </div>
</x-casteaching-layout>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('image-preview');
            output.src = reader.result;
            output.style.display = 'block';
            document.getElementById('upload-icon').style.display = 'none';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

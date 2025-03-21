<x-casteaching-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $serie->title }}
        </h2>
    </x-slot>

    <div class="mx-auto sm:px-6 lg:px-8 w-full max-w-7xl">
        @can('users_manage_create')
            <div class="p-4 mt-10">
                <!-- Afegeix l'acció amb la ruta adequada -->
                <form method="POST" action="{{ route('manage.series.update', $serie->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="space-y-12">
                        <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                            <div>
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Series</h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">Informació bàsica d'una serie</p>
                            </div>
                            <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                                <div class="col-span-full">
                                    <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Títol</label>
                                    <div class="mt-2">
                                        <input id="title" name="title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6" placeholder="Title" value="{{ $serie->title }}">
                                    </div>
                                </div>
                                <div class="col-span-full">
                                    <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                                    <div class="mt-2">
                                        <textarea id="description" name="description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">{{ $serie->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-span-full">
                                    <label for="teacher_name" class="block text-sm font-medium leading-6 text-gray-900">Nom del Professor</label>
                                    <div class="mt-2">
                                        <input id="teacher_name" name="teacher_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6" placeholder="Teacher Name" value="{{ $serie->teacher_name }}">
                                    </div>
                                </div>
                                <div class="col-span-full">
                                    <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Imatge</label>
                                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                        <div class="text-center">
                                            @if($serie->image)
                                                <img id="image-preview" src="{{ asset('storage/' . $serie->image) }}" alt="{{ $serie->title }}" class="mx-auto h-24 w-24 object-cover rounded-lg mb-4"/>
                                            @else
                                                <img id="image-preview" src="#" alt="" class="mx-auto h-24 w-24 object-cover rounded-lg mb-4 hidden" />
                                            @endif
                                            <svg id="upload-icon" class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a.75.75 0 01-2.25.75H3.75A.75.75 0 011.5 18V6zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                            </svg>
                                            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                                <label for="image" class="relative cursor-pointer rounded-md bg-white font-semibold text-red-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-red-600 focus-within:ring-offset-2 hover:text-red-500">
                                                    <span>Penja una imatge</span>
                                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*" onchange="previewImage(event)" />
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
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

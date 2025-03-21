<x-casteaching-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">{{ __('Informació del perfil') }}</h3>
                    <p class="mt-1 text-sm text-gray-600">{{ __("Aqui pots veure la informació personal d'aquest usuari.") }}</p>

                    <!-- Profile Photo -->
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="col-span-6 sm:col-span-4 mt-10">
                            <x-label for="photo" value="{{ __('Photo') }}" />
                            <div class="mt-2 flex items-center">
                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="rounded-full h-20 w-20 object-cover mr-4">
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900">{{ $user->name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mt-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-10">
                            <!-- Name -->
                            <div>
                                <x-label for="name" value="{{ __('Name') }}" />
                                <x-input id="name" type="text" class="mt-1 block w-full" value="{{ $user->name }}" disabled />
                            </div>

                            <!-- Email -->
                            <div>
                                <x-label for="email" value="{{ __('Email') }}" />
                                <x-input id="email" type="email" class="mt-1 block w-full" value="{{ $user->email }}" disabled />
                            </div>
                        </div>
                    </div>

                    <div class="flex mt-14 justify-end">
                        <a href="/manage/users" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Tornar enrere</a>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-casteaching-layout>

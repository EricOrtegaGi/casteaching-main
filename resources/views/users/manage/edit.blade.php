<x-casteaching-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}
        </x-slot>

    <div class="mx-auto sm:px-6 lg:px-8 w-full max-w-7xl">

        @can('users_manage_create')
            <div class="p-4 mt-10">
            <form data-qa="form_user_edit" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-12">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                        <div>
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Users</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Informació bàsica del usuari</p>
                        </div>

                        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

                        <div class="col-span-full">
                                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                    <div class="mt-2">
                                        <input id="name" name="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6" placeholder="User" value="{{ $user->name }}"></input>
                                    </div>
                                </div>

                                <div class="col-span-full">
                                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                                    <div class="mt-2">
                                        <input id="email" name="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6" placeholder="user@example.com" value="{{ $user->email }}"></input>
                                    </div>
                                </div>

                                <div class="col-span-full">
                                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                    <div class="mt-2">
                                        <input id="password" name="password" type="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6" placeholder="12345678"></input>
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

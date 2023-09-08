<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $hospital->id ? 'Editar Hospital' : 'Crear Hospital' }}
        </h2>
    </x-slot>
    <div class="">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <x-alert />
            <br>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <form action="{{ $hospital->id ? route('admin.hospitals.update', $hospital->id) : route('admin.hospitals.crear') }}" method="POST">
                        @csrf
                        @if ($hospital->id)
                            @method('PUT')
                        @endif

                        <div class="mt-4 space-y-4">
                            <input type="hidden" name="id" id="id" value="{{ $hospital->id }}" />

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $hospital->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dirección</label>
                                <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('address', $hospital->address) }}</textarea>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono del hospital</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $hospital->phone) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correo del hospital</label>
                                <input type="text" name="email" id="email" value="{{ old('email', $hospital->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div>
                                <label for="contact_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contacto</label>
                                <input type="text" name="contact_name" id="contact_name" value="{{ old('contact_name', $hospital->contact_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <x-input-error :messages="$errors->get('contact_name')" class="mt-2" />
                            </div>

                            <div>
                                <label for="contact_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono del contacto</label>
                                <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $hospital->contact_phone) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <x-input-error :messages="$errors->get('contact_phone')" class="mt-2" />
                            </div>

                            <div>
                                <label for="contact_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correo del contacto</label>
                                <input type="text" name="contact_email" id="contact_email" value="{{ old('contact_email', $hospital->contact_email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <x-input-error :messages="$errors->get('contact_email')" class="mt-2" />
                            </div>

                            <!-- Agrega más campos aquí -->

                            <div class="mt-6">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 dark:bg-gray-600 dark:border-gray-600 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                    {{ $hospital->id ? 'Guardar Cambios' : 'Crear Hospital' }}
                                </button>

                                <a href="{{ route('admin.hospitals') }}" type="button" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 dark:bg-gray-600 dark:border-gray-600 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                    Cancelar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

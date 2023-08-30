<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Hospital') }}
        </h2>
    </x-slot>
    <div class="">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <x-alert />
            <br>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <form action="{{ route('hospital.update') }}" method="POST">
                        @csrf


                        @method('PUT')
                        <div class="mt-4 space-y-4">
                            <input type="hidden" name="id" id="id" value="{{ $hospital->id }}" />

                            <div>
                                <label for="nombre"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                                <input type="text" name="nombre" id="nombre" value="{{ $hospital->nombre }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />

                            </div>
                            <div>
                                <label for="direccion"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dirección</label>
                                <textarea name="direccion" id="direccion" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $hospital->direccion }}</textarea>
                                <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
                            </div>
                            <div>
                                <label for="telefono"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono del
                                    hospital</label>
                                <input type="text" name="telefono" id="telefono" value="{{ $hospital->telefono }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                            </div>
                            <div>
                                <label for="correo"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correo del
                                    hospital</label>
                                <input type="text" name="correo" id="correo" value="{{ $hospital->correo }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <x-input-error :messages="$errors->get('correo')" class="mt-2" />
                            </div>
                            <div>
                                <label for="contacto"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contacto</label>
                                <input type="text" name="contacto" id="contacto"
                                    value="{{ $hospital->contacto_nombre }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <x-input-error :messages="$errors->get('contacto')" class="mt-2" />
                            </div>

                            <div>
                                <label for="contacto_telefono"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono del
                                    contacto</label>
                                <input type="text" name="contacto_telefono" id="contacto_telefono"
                                    value="{{ $hospital->contacto_telefono }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <x-input-error :messages="$errors->get('contacto_telefono')" class="mt-2" />
                            </div>


                            <div>
                                <label for="contacto_correo"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correo del
                                    contacto</label>
                                <input type="text" name="contacto_correo" id="contacto_correo"
                                    value="{{ $hospital->contacto_correo }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <x-input-error :messages="$errors->get('contacto_correo')" class="mt-2" />
                            </div>
                            <!-- Agrega más campos aquí -->

                            <div class="mt-6">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 dark:bg-gray-600 dark:border-gray-600 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                    Guardar Cambios
                                </button>

                                <a href="{{route('hospital.detalle',  $hospital->id)}}" type="button"
                                    class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 dark:bg-gray-600 dark:border-gray-600 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                    Cancelar
                            </a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>


</x-app-layout>

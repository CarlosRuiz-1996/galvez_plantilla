<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-purple-800 dark:text-gray-200 leading-tight">
            {{ __('Elige tu hospital') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert />

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{route('hospitals.asignar.save')}}" method="post">
                    @csrf
                    <div class="flex p-5">
                        <label for="underline_select" class="sr-only">Underline select</label>
                        <select id="id" name="id" required
                            class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option value="" disabled selected>Elige tu hospital</option>
                            @foreach ($hospitales as $hos)
                                <option value="{{ $hos->id }}">{{ $hos->name . '-' . $hos->address }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex p-5">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Aceptar
                        </button>
                    </div>

                </form>
            </div>
        </div>


    </div>
    </div>


</x-app-layout>

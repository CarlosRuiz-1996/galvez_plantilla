@if (session('status'))
    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
        class=" bg-green-100 dark:bg-green-600 border-green-400 dark:border-green-600 text-green-700 dark:text-green-100 px-4 py-3 rounded relative"
        role="alert">
        <strong class="font-bold">¡Éxito!</strong>
        <span class="block sm:inline">{{ session('status') }}</span>
    </div>
@endif

@if (session()->has('success'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
        role="alert">
        <span class="font-medium">Success! </span> {{ session('success') }}
    </div>
@endif

@if (session()->has('error'))
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
        <span class="font-medium">Error! </span> {{ session('error') }}
    </div>
@endif

@if (session()->has('warning'))
    <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800"
        role="alert">
        <span class="font-medium">Warning! </span> {{ session('warning') }}
    </div>
@endif

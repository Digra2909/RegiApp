<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 bg-gray-900 dark:bg-white border border-transparent rounded-xl font-semibold text-xs text-white dark:text-gray-900 uppercase tracking-widest hover:bg-gray-800 dark:hover:bg-gray-100 focus:bg-gray-800 dark:focus:bg-gray-100 active:bg-gray-950 dark:active:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-150 shadow-sm hover:shadow-md']) }}>
    {{ $slot }}
</button>

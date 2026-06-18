<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900 rounded-xl flex items-center justify-center">
                <i class="bi bi-person-gear text-indigo-600 dark:text-indigo-400 text-lg"></i>
            </div>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Profile') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Gérez vos informations personnelles et la sécurité de votre compte</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-2xl border border-gray-200/60 dark:border-gray-700/60 overflow-hidden">
                <div class="p-6 sm:p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-2xl border border-gray-200/60 dark:border-gray-700/60 overflow-hidden">
                <div class="p-6 sm:p-8">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-2xl border border-red-200/60 dark:border-red-900/60 overflow-hidden">
                <div class="p-6 sm:p-8">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<section class="space-y-6">
    <header class="flex items-start gap-3">
        <div class="w-9 h-9 bg-red-100 dark:bg-red-900/50 rounded-lg flex items-center justify-center shrink-0">
            <i class="bi bi-exclamation-triangle text-red-600 dark:text-red-400"></i>
        </div>
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                {{ __('Delete Account') }}
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </p>
        </div>
    </header>

    <div class="flex">
        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >
            <i class="bi bi-trash3 me-1.5"></i>
            {{ __('Delete Account') }}
        </x-danger-button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-red-100 dark:bg-red-900/50 rounded-xl flex items-center justify-center">
                    <i class="bi bi-exclamation-triangle-fill text-red-600 dark:text-red-400 text-lg"></i>
                </div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>
            </div>

            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 mb-6">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="flex items-center gap-1.5">
                    <i class="bi bi-x-lg"></i>
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="flex items-center gap-1.5">
                    <i class="bi bi-trash3"></i>
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>

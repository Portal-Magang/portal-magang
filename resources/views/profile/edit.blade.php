<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Foto Profil
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Unggah foto profil (JPG / PNG, max 2MB)
        </p>
    </header>

    <form method="post"
          action="{{ route('profile.photo.update') }}"
          enctype="multipart/form-data"
          class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <img src="{{ auth()->user()->photo_profile_url }}"
                 alt="Foto Profil"
                 class="w-24 h-24 rounded-full object-cover mb-3">

            <input type="file"
                   name="photo_profile"
                   accept="image/*"
                   class="block w-full text-sm">
            <x-input-error :messages="$errors->get('photo_profile')" class="mt-2" />
        </div>

        <x-primary-button>Simpan Foto</x-primary-button>

        @if (session('status') === 'photo-updated')
            <p class="text-sm text-gray-600">Foto profil diperbarui.</p>
        @endif
    </form>
    </section>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

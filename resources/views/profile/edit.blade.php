@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8">

    <h1 class="text-2xl font-bold text-[#001B61] mb-6">
        Profil Saya
    </h1>

    {{-- FOTO PROFIL --}}
    <div class="flex items-center gap-6 mb-8">
        <img
            src="{{ auth()->user()->photo_profile
                ? asset('storage/' . auth()->user()->photo_profile)
                : asset('asset/default-avatar.png') }}"
            class="w-24 h-24 rounded-full object-cover border">

        <form method="POST" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="photo_profile" class="text-sm">
            <button class="mt-2 px-4 py-2 bg-[#001B61] text-white rounded-lg text-sm">
                Ganti Foto
            </button>
        </form>
    </div>

    {{-- FORM PROFIL --}}
    <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="text-sm font-medium">Nama</label>
            <input type="text" name="name" value="{{ auth()->user()->name }}"
                class="w-full mt-1 rounded-lg border-gray-300">
        </div>

        <div>
            <label class="text-sm font-medium">Username</label>
            <input type="text" name="username" value="{{ auth()->user()->username }}"
                class="w-full mt-1 rounded-lg border-gray-300">
        </div>

        <div>
            <label class="text-sm font-medium">Email</label>
            <input type="email" value="{{ auth()->user()->email }}"
                class="w-full mt-1 rounded-lg border-gray-200 bg-gray-100" disabled>
        </div>

        <button class="px-6 py-3 bg-[#001B61] text-white rounded-xl font-semibold">
            Simpan Perubahan
        </button>
    </form>

</div>
@endsection

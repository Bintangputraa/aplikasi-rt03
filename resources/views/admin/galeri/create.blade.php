<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Galeri (Foto / Video)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
                @endif

                <!-- enctype="multipart/form-data" sangat wajib jika ada form upload file -->
                <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label>Pilih Album Kegiatan</label>
                        <select name="album_id" class="form-control" required>
                            <option value="">-- Pilih Album --</option>
                            @foreach(\App\Models\Album::all() as $album)
                            <option value="{{ $album->id }}">{{ $album->judul }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Opsi 1: Upload File dari Komputer -->
                    <div class="mb-3">
                        <label>Atau Upload File (Opsional)</label>
                        <input type="file" name="file_media" class="form-control">
                    </div>

                    <!-- Opsi 2: Masukkan Link Google Drive / Video -->
                    <div class="mb-3">
                        <label>Atau Masukkan Link Google Drive / YouTube / Web</label>
                        <input type="text" name="link_url" class="form-control" placeholder="https://drive.google.com/...">
                    </div>

                    <button type="submit" class="btn btn-success">Simpan ke Album</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
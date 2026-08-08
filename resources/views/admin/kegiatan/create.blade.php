<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Jadwal Kegiatan') }}
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

                <form action="{{ route('kegiatan.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" placeholder="Contoh: Kerja Bakti Bersihkan Selokan" class="shadow appearance-none border rounded w-full py-2 px-3" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Waktu Pelaksanaan</label>
                        <!-- Input type="datetime-local" akan memunculkan kalender dan jam di browser -->
                        <input type="datetime-local" name="waktu_pelaksanaan" class="shadow appearance-none border rounded w-full py-2 px-3" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Lokasi</label>
                        <input type="text" name="lokasi" value="Lingkungan RT 03 RW 13 Cemani" class="shadow appearance-none border rounded w-full py-2 px-3" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Tambahan (Opsional)</label>
                        <textarea name="deskripsi" rows="3" placeholder="Contoh: Warga diharap membawa sabit dan cangkul..." class="shadow appearance-none border rounded w-full py-2 px-3"></textarea>
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan Kegiatan</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
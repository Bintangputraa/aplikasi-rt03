@if (session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
    {{ session('error') }}
</div>
@endif
<form action="{{ route('admin.album.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Judul Album / Kegiatan:</label>
        <input type="text" name="judul" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label>Foto Sampul (Cover):</label>
        <input type="file" name="cover_foto" class="form-control" required>
    </div>

    <!-- TAMPILAN BARU: Input Link Folder Drive -->
    <div class="mb-3">
        <label>Link Folder Google Drive:</label>
        <input type="text" name="link_folder" class="form-control" placeholder="https://drive.google.com/drive/folders/..." required>
        <small>Pastikan hak akses folder diatur ke: "Siapa saja yang memiliki link (Anyone with the link)"</small>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Album</button>
</form>
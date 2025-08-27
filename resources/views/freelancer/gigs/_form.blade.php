@csrf
<div class="row">
    <div class="col-md-12 form-group">
        <label for="title">Judul Jasa</label>
        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" 
               value="{{ old('title', $gig->title ?? '') }}" required>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12 form-group">
        <label for="service">Jenis Layanan (Kategori)</label>
        <input type="text" id="service" name="service" class="form-control @error('service') is-invalid @enderror" 
               placeholder="Contoh: Desain Logo, Penulisan Artikel, Web Development" 
               value="{{ old('service', $gig->service ?? '') }}" required>
        @error('service')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12 form-group">
        <label for="description">Deskripsi Jasa</label>
        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" 
                  rows="5" required>{{ old('description', $gig->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 form-group">
        <label for="price">Harga (Rp)</label>
        <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror" 
               placeholder="Contoh: 500000" value="{{ old('price', $gig->price ?? '') }}" required>
        @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 form-group">
        <label for="estimated_time">Estimasi Pengerjaan</label>
        <input type="text" id="estimated_time" name="estimated_time" class="form-control @error('estimated_time') is-invalid @enderror" 
               placeholder="Contoh: 3 Hari, 1 Minggu" value="{{ old('estimated_time', $gig->estimated_time ?? '') }}" required>
        @error('estimated_time')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12 form-group">
        <label for="cover_image">Gambar Cover</label>
        <input type="file" id="cover_image" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror" 
               accept="image/*">
        @error('cover_image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @if (isset($gig) && $gig->cover_image_path)
            <div class="mt-2">
                <p>Gambar saat ini:</p>
                <img src="{{ Storage::url($gig->cover_image_path) }}" alt="Cover Image" style="max-width: 200px; border-radius: 8px;">
            </div>
        @endif
    </div>
</div>
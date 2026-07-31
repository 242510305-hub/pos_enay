@csrf

{{-- Foto Saat Ini --}}
@if (!empty($user->foto))
    <div class="mb-3">
        <label class="form-label">Foto Saat Ini</label><br>
        <img src="{{ asset('storage/'. $user->foto) }}" width="150" class="img-thumbnail">
    </div>
@endif

{{-- Input Gambar & Preview --}}
<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">Upload Foto</label>
        {{-- Perbaikan typo: form-control --}}
        <input type="file" 
               name="foto" 
               onchange="previewImage(this)" 
               class="form-control @error('foto') is-invalid @enderror">
        @error('foto')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Preview Foto Baru</label><br>
        <img id="preview" class="img-thumbnail" style="display:none" width="150">
    </div>
</div>

{{-- Input Nama --}}
<div class="mb-3">
    <label class="form-label">Nama</label>
    {{-- Disesuaikan menggunakan $user->name --}}
    <input type="text" name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $user->name ?? '') }}">
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

{{-- Input Email --}}
<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email"
        class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email', $user->email ?? '') }}">
    @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

{{-- Input Password --}}
<div class="mb-3">
    <label class="form-label">Password {{ isset($user) ? '(Kosongkan jika tidak diubah)' : '' }}</label>
    <input type="password" name="password"
        class="form-control @error('password') is-invalid @enderror">
    @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

{{-- Input Role --}}
<div class="mb-3">
    <label class="form-label">Role</label>
    <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
        <option value="">-- Pilih Role --</option>
        @foreach($roles as $role)
            <option value="{{ $role->id }}" @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                {{ ucfirst($role->name) }}
            </option>
        @endforeach
    </select>
    @error('role_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<button type="submit" class="btn btn-success">Simpan</button>

{{-- Pastikan nama route ini sesuai dengan route di web.php kamu --}}
<a href="{{ Route::has('admin.users.index') ? route('admin.users.index') : url('/admin/users') }}" class="btn btn-secondary">
    Kembali
</a>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="mb-0">Edit Project</h3>
                            <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-arrow-left me-1"></i> Back to Projects
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('projects.update', $project) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Project Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $project->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="pekerjaan" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $project->pekerjaan) }}" required>
                                @error('pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="lokasi" class="form-label">Lokasi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" value="{{ old('lokasi', $project->lokasi) }}" required>
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="kementerian" class="form-label">Kementerian/Lembaga/Perangkat Daerah/Institusi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kementerian') is-invalid @enderror" id="kementerian" name="kementerian" value="{{ old('kementerian', $project->kementerian) }}" required>
                                @error('kementerian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="konsultan_perencana" class="form-label">Konsultan Perencana <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('konsultan_perencana') is-invalid @enderror" id="konsultan_perencana" name="konsultan_perencana" value="{{ old('konsultan_perencana', $project->konsultan_perencana) }}" required>
                                @error('konsultan_perencana')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="konsultan_mk" class="form-label">Konsultan MK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('konsultan_mk') is-invalid @enderror" id="konsultan_mk" name="konsultan_mk" value="{{ old('konsultan_mk', $project->konsultan_mk) }}" required>
                                @error('konsultan_mk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="kontraktor_pelaksana" class="form-label">Kontraktor Pelaksana <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kontraktor_pelaksana') is-invalid @enderror" id="kontraktor_pelaksana" name="kontraktor_pelaksana" value="{{ old('kontraktor_pelaksana', $project->kontraktor_pelaksana) }}" required>
                                @error('kontraktor_pelaksana')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="metode_pemilihan" class="form-label">Metode Pemilihan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('metode_pemilihan') is-invalid @enderror" id="metode_pemilihan" name="metode_pemilihan" value="{{ old('metode_pemilihan', $project->metode_pemilihan) }}" required>
                                @error('metode_pemilihan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nilai_kontrak" class="form-label">Nilai Kontrak <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" step="0.01" class="form-control @error('nilai_kontrak') is-invalid @enderror" id="nilai_kontrak" name="nilai_kontrak" value="{{ old('nilai_kontrak', $project->nilai_kontrak) }}" required>
                                </div>
                                @error('nilai_kontrak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_spmk" class="form-label">Tanggal SPMK <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal_spmk') is-invalid @enderror" id="tanggal_spmk" name="tanggal_spmk" value="{{ old('tanggal_spmk', optional($project->tanggal_spmk)->format('Y-m-d')) }}" required>
                                @error('tanggal_spmk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jangka_waktu" class="form-label">Jangka Waktu (Hari) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('jangka_waktu') is-invalid @enderror" id="jangka_waktu" name="jangka_waktu" value="{{ old('jangka_waktu', $project->jangka_waktu) }}" required>
                                @error('jangka_waktu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $project->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $project->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('projects.index') }}" class="btn btn-light">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Project</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
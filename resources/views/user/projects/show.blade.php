<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details - {{ config('app.name') }}</title>
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
                            <h3 class="mb-0">Project Details</h3>
                            <div class="d-flex gap-2">
                                <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-arrow-left me-1"></i> Back to Projects
                                </a>
                                <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil me-1"></i> Edit Project
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Project Name</h6>
                                <p class="mb-0">{{ $project->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Status</h6>
                                <span class="badge {{ $project->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $project->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Pekerjaan</h6>
                                <p class="mb-0">{{ $project->pekerjaan }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Lokasi</h6>
                                <p class="mb-0">{{ $project->lokasi }}</p>
                            </div>
                            <div class="col-12">
                                <h6 class="text-muted mb-1">Kementerian/Lembaga/Perangkat Daerah/Institusi</h6>
                                <p class="mb-0">{{ $project->kementerian }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Konsultan Perencana</h6>
                                <p class="mb-0">{{ $project->konsultan_perencana }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Konsultan MK</h6>
                                <p class="mb-0">{{ $project->konsultan_mk }}</p>
                            </div>
                            <div class="col-12">
                                <h6 class="text-muted mb-1">Kontraktor Pelaksana</h6>
                                <p class="mb-0">{{ $project->kontraktor_pelaksana }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Metode Pemilihan</h6>
                                <p class="mb-0">{{ $project->metode_pemilihan }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Nilai Kontrak</h6>
                                <p class="mb-0">Rp {{ number_format($project->nilai_kontrak, 2, ',', '.') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Tanggal SPMK</h6>
                                <p class="mb-0">{{ $project->tanggal_spmk->format('d F Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Jangka Waktu</h6>
                                <p class="mb-0">{{ $project->jangka_waktu }} Hari</p>
                            </div>
                            @if($project->description)
                            <div class="col-12">
                                <h6 class="text-muted mb-1">Description</h6>
                                <p class="mb-0">{{ $project->description }}</p>
                            </div>
                            @endif
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Created At</h6>
                                <p class="mb-0">{{ $project->created_at->format('d F Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-1">Last Updated</h6>
                                <p class="mb-0">{{ $project->updated_at->format('d F Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Progress Submission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        body {
            background-color: #f0f4f8;
        }

        .container {
            max-width: 95%;
        }

        .card {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: none;
        }

        .table td, .table th {
            white-space: nowrap;
        }

        .progress-bar {
            transition: width 0.4s ease;
        }

        .form-upload-group {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .badge {
            font-size: 0.85em;
        }

        .btn-upload {
            min-width: 100px;
        }

        .form-control[type=file] {
            min-width: 200px;
        }

        .project-select-wrapper {
            background-color: #e9f5ff;
            border-left: 5px solid #0d6efd;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <!-- Project Dropdown -->
    <div class="project-select-wrapper">
        <form method="GET" action="">
            <div class="row align-items-center">
                <div class="col-md-4 mb-2">
                    <label for="project" class="form-label fw-bold">Pilih Proyek</label>
                    <select class="form-select" id="project" name="project">
                        <option value="1">Proyek A</option>
                        <option value="2">Proyek B</option>
                        <option value="3">Proyek C</option>
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <button class="btn btn-primary w-100 mt-4" type="submit">
                        <i class="fas fa-sync-alt me-1"></i> Tampilkan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h4 class="mb-0">Progress Submission</h4>
                    <span class="badge bg-light text-primary">Total: {{ $totalScore ?? 0 }}/{{ $maxScore ?? 0 }}</span>
                </div>
                <div class="card-body">
                    <div class="progress mb-3" style="height: 22px;">
                        <div class="progress-bar bg-success" role="progressbar" 
                             style="width: {{ ($maxScore > 0) ? (($totalScore ?? 0) / $maxScore * 100) : 0 }}%">
                            {{ ($maxScore > 0) ? number_format(($totalScore ?? 0) / $maxScore * 100, 1) : 0 }}%
                        </div>
                    </div>
                    <div class="small text-muted">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Dokumen Disetujui:</span>
                            <span>{{ $approvedCount ?? 0 }}/{{ $totalDocuments ?? 0 }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Rata-rata Skor:</span>
                            <span>{{ ($maxScore > 0) ? number_format(($totalScore ?? 0) / $maxScore * 100, 1) : 0 }}%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Upload -->
            <div class="card">
                <div class="card-header bg-light">
                    <h4 class="mb-0">Form Upload Dokumen</h4>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('guest.submissions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Dokumen</th>
                                        <th>Periode</th>
                                        <th>Status</th>
                                        <th>Skor</th>
                                        <th>Maks.</th>
                                        <th>Nilai %</th>
                                        <th>AVG</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($documentTypes as $category => $types)
                                    <tr class="table-secondary">
                                        <td colspan="8"><strong>{{ $category }}</strong></td>
                                    </tr>
                                    @foreach($types as $type)
                                        <tr>
                                            <td>
                                                {{ $type->name }}
                                                @if($type->description)
                                                    <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" title="{{ $type->description }}"></i>
                                                @endif
                                                @if(isset($submissionFiles[$type->id]))
                                                    @if($submissionFiles[$type->id]->approval_memo)
                                                        <small class="text-muted d-block">Catatan: {{ $submissionFiles[$type->id]->approval_memo }}</small>
                                                    @endif
                                                    @if($submissionFiles[$type->id]->memo)
                                                        <small class="text-muted d-block">Memo: {{ $submissionFiles[$type->id]->memo }}</small>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $type->period ?? '-' }}</td>
                                            <td>
                                                @if(isset($submissionFiles[$type->id]))
                                                    @if($submissionFiles[$type->id]->isPending())
                                                        <span class="badge bg-warning">Menunggu Review</span>
                                                    @elseif($submissionFiles[$type->id]->isApproved())
                                                        <span class="badge bg-success">Disetujui</span>
                                                    @else
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-secondary">Belum Upload</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $submissionFiles[$type->id]->score ?? '-' }}</td>
                                            <td class="text-center">{{ $type->max_score ?? '-' }}</td>
                                            <td class="text-center">
                                                @if(isset($submissionFiles[$type->id]) && $type->max_score > 0)
                                                    {{ number_format(($submissionFiles[$type->id]->score / $type->max_score) * 100, 1) }}%
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                {{ isset($submissionFiles[$type->id]) ? number_format($submissionFiles[$type->id]->average_score ?? 0, 1) : '-' }}
                                            </td>
                                            <td>
                                                <div class="form-upload-group">
                                                    <input type="file" class="form-control form-control-sm @error('documents.' . $type->id) is-invalid @enderror"
                                                           name="documents[{{ $type->id }}]"
                                                           accept=".pdf,.doc,.docx,.xls,.xlsx">

                                                    <button type="submit" class="btn btn-sm btn-primary btn-upload">
                                                        <i class="fas fa-upload me-1"></i> Upload
                                                    </button>

                                                    @if(isset($submissionFiles[$type->id]) && $submissionFiles[$type->id]->file_path)
                                                        <a href="{{ route('download.file', $submissionFiles[$type->id]->id) }}" class="btn btn-sm btn-outline-secondary" title="Download File">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                                @error('documents.' . $type->id)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-paper-plane me-1"></i> Submit Semua Upload
                            </button>
                        </div>
                    </form>
                    <small class="text-muted d-block mt-2">Format: PDF, DOC, DOCX, XLS, XLSX (max 10MB)</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
</body>
</html>

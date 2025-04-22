@extends('layouts.app')

@push('styles')
<style>
    .progress-wrapper {
        padding: 4px 0;
    }
    .table > :not(caption) > * > * {
        padding: 0.75rem;
        background-color: var(--bs-table-bg);
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    }
    .table td {
        vertical-align: middle;
    }
    .badge {
        font-size: 0.85em;
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Progress Submission</h4>
                    <span class="badge bg-primary">Total: {{ $totalScore ?? 0 }}/{{ $maxScore ?? 0 }}</span>
                </div>
                <div class="card-body">
                    <div class="progress mb-3" style="height: 20px;">
                        <div class="progress-bar" role="progressbar" 
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
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
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
                        

                        <div class="mb-4">
                            <h5>Upload Dokumen</h5>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 25%">Nama Dokumen</th>
                                            <th style="width: 10%">Periode</th>
                                            <th style="width: 10%">Status</th>
                                            <th style="width: 10%">Skor Penilaian</th>
                                            <th style="width: 10%">Skor Maks.</th>
                                            <th style="width: 10%">Nilai %</th>
                                            <th style="width: 10%">AVG</th>
                                            <th style="width: 15%">Aksi</th>
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
                                                    <div class="d-flex align-items-center">
                                                        <span>
                                                            {{ $type->name }}
                                                            @if($type->description)
                                                                <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ $type->description }}"></i>
                                                            @endif
                                                        </span>
                                                    </div>
                                                    @if(isset($submissionFiles[$type->id]))
                                                        @if($submissionFiles[$type->id]->approval_memo)
                                                            <small class="text-muted d-block">Catatan: {{ $submissionFiles[$type->id]->approval_memo }}</small>
                                                        @endif
                                                        @if($submissionFiles[$type->id]->memo)
                                                            <small class="text-muted d-block">Memo: {{ $submissionFiles[$type->id]->memo }}</small>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{ $type->period ?? '-' }}
                                                </td>
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
                                                <td class="text-center">
                                                    {{ isset($submissionFiles[$type->id]) ? $submissionFiles[$type->id]->score : '-' }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $type->max_score ?? '-' }}
                                                </td>
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
                                                    @if(isset($submissionFiles[$type->id]))
                                                        @if($submissionFiles[$type->id]->isApproved())
                                                            <div class="progress-wrapper">
                                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                                    <span class="badge bg-success">{{ $submissionFiles[$type->id]->score }}/{{ $type->max_score }}</span>
                                                                    <small class="text-success">{{ ($type->max_score > 0) ? number_format(($submissionFiles[$type->id]->score / $type->max_score) * 100, 1) : 0 }}%</small>
                                                                </div>
                                                                <div class="progress" style="height: 8px;">
                                                                    <div class="progress-bar bg-success" role="progressbar" 
                                                                         style="width: {{ ($type->max_score > 0) ? (($submissionFiles[$type->id]->score / $type->max_score) * 100) : 0 }}%">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @elseif($submissionFiles[$type->id]->isPending())
                                                            <div class="progress-wrapper">
                                                                <div class="progress" style="height: 8px;">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: 100%"></div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="progress-wrapper">
                                                                <div class="progress" style="height: 8px;">
                                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"></div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="progress-wrapper">
                                                            <div class="progress" style="height: 8px;">
                                                                <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%"></div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2 align-items-center">
                                                        <input type="file" class="form-control form-control-sm @error('documents.' . $type->id) is-invalid @enderror" 
                                                            id="document_{{ $type->id }}" name="documents[{{ $type->id }}]" 
                                                            accept=".pdf,.doc,.docx,.xls,.xlsx">
                                                        @if(isset($submissionFiles[$type->id]) && $submissionFiles[$type->id]->file_path)
                                                            <a href="{{ route('download.file', $submissionFiles[$type->id]->id) }}" 
                                                                class="btn btn-sm btn-outline-primary">
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
                            <small class="text-muted">Format: PDF, DOC, DOCX, XLS, XLSX (max 10MB)</small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Upload Dokumen</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
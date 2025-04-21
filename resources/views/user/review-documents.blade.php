@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Review Dokumen Submission #{{ $submission->id }}</h4>
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <h5>Detail Proyek</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Pekerjaan:</strong> {{ $submission->projectDetail->pekerjaan }}</p>
                                <p><strong>Lokasi:</strong> {{ $submission->projectDetail->lokasi }}</p>
                                <p><strong>Institusi:</strong> {{ $submission->projectDetail->institusi }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Nilai Kontrak:</strong> Rp {{ number_format($submission->projectDetail->nilai_kontrak, 0, ',', '.') }}</p>
                                <p><strong>Tanggal SPMK:</strong> {{ $submission->projectDetail->tanggal_spmk }}</p>
                                <p><strong>Jangka Waktu:</strong> {{ $submission->projectDetail->jangka_waktu }} hari</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5>Dokumen Submission</h5>
                        <hr>
                        @foreach($documentTypes as $category => $types)
                            <div class="mb-4">
                                <h6>{{ $category }}</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Jenis Dokumen</th>
                                                <th>File</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($types as $type)
                                                <tr>
                                                    <td>
                                                        {{ $type->name }}
                                                        <i class="fas fa-info-circle text-muted" title="{{ $type->description }}"></i>
                                                    </td>
                                                    <td>
                                                        @if($file = $submission->files->where('document_type_id', $type->id)->first())
                                                            <a href="{{ route('user.submissions.download-file', $file->id) }}" class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-download"></i> {{ $file->original_name }}
                                                            </a>
                                                        @else
                                                            <span class="text-muted">Tidak ada file</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($file)
                                                            @if($file->isPending())
                                                                <span class="badge bg-warning">Menunggu Review</span>
                                                            @elseif($file->isApproved())
                                                                <span class="badge bg-success">Disetujui</span>
                                                            @else
                                                                <span class="badge bg-danger">Ditolak</span>
                                                            @endif
                                                            @if($file->approval_memo)
                                                                <br>
                                                                <small class="text-muted">{{ $file->approval_memo }}</small>
                                                            @endif
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($file && $file->isPending())
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#approveModal{{ $file->id }}">
                                                                    <i class="fas fa-check"></i> Setujui
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $file->id }}">
                                                                    <i class="fas fa-times"></i> Tolak
                                                                </button>
                                                            </div>

                                                            <!-- Approve Modal -->
                                                            <div class="modal fade" id="approveModal{{ $file->id }}" tabindex="-1">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form action="{{ route('user.submissions.approve-file', $file->id) }}" method="POST">
                                                                            @csrf
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Setujui Dokumen</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="mb-3">
                                                                                    <label for="approvalMemo{{ $file->id }}" class="form-label">Catatan (Opsional)</label>
                                                                                    <textarea class="form-control" id="approvalMemo{{ $file->id }}" name="memo" rows="3"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit" class="btn btn-success">Setujui</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Reject Modal -->
                                                            <div class="modal fade" id="rejectModal{{ $file->id }}" tabindex="-1">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form action="{{ route('user.submissions.reject-file', $file->id) }}" method="POST">
                                                                            @csrf
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Tolak Dokumen</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="mb-3">
                                                                                    <label for="rejectMemo{{ $file->id }}" class="form-label">Alasan Penolakan</label>
                                                                                    <textarea class="form-control" id="rejectMemo{{ $file->id }}" name="memo" rows="3" required></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit" class="btn btn-danger">Tolak</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('user.submissions.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
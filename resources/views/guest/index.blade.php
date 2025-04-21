@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Video Tutorial Card -->
            <div class="card mb-4">
                <div class="card-header">{{ __('Tutorial Video') }}</div>
                <div class="card-body">
                    <div class="ratio ratio-16x9 mb-4">
                        <iframe src="https://www.youtube.com/embed/your-video-id" title="Tutorial Video" allowfullscreen></iframe>
                    </div>
                    <p class="text-muted">{{ __('Watch this tutorial video to understand how to properly submit your documents.') }}</p>
                </div>
            </div>

            <!-- Upload Options Card -->
            <div class="card mb-4">
                <div class="card-header">{{ __('Choose Upload Method') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ __('Self Upload') }}</h5>
                                    <p class="card-text">{{ __('Upload and manage your documents directly.') }}</p>
                                    <a href="{{ route('guest.upload') }}" class="btn btn-primary">
                                        {{ __('Upload Documents') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ __('Request User Upload') }}</h5>
                                    <p class="card-text">{{ __('Let our team handle your document upload and verification.') }}</p>
                                    <a href="{{ route('guest.request-upload') }}" class="btn btn-secondary">
                                        {{ __('Request Upload') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Self Upload Modal -->
            <div class="modal fade" id="selfUploadModal" tabindex="-1" aria-labelledby="selfUploadModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="selfUploadModalLabel">{{ __('Upload Documents') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('guest.files.upload') }}" method="POST" enctype="multipart/form-data" class="dropzone" id="fileUpload">
                                @csrf
                                <div class="fallback">
                                    <input type="file" name="file" class="form-control">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="document_type">Document Type</label>
                                    <select name="document_type_id" class="form-control" required>
                                        @foreach($documentTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            <div class="form-group mt-3">
                                <label for="memo">Additional Notes (Optional)</label>
                                <textarea name="memo" class="form-control" rows="3" placeholder="Add any notes about missing requirements or additional information"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Upload</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Request Upload Modal -->
            <div class="modal fade" id="requestUploadModal" tabindex="-1" aria-labelledby="requestUploadModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="requestUploadModalLabel">{{ __('Request Document Upload') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('guest.upload.request') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="request_notes" class="form-label">{{ __('Notes for Upload Team') }}</label>
                                    <textarea class="form-control" id="request_notes" name="notes" rows="4" required placeholder="Please describe the documents you need help uploading and any special requirements."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('Submit Request') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents Table Card -->
            <div class="card">
                <div class="card-header">{{ __('Your Documents') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Document Type</th>
                                    <th>File Name</th>
                                    <th>Upload Date</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($submissions as $submission)
                                    @foreach($submission->files as $file)
                                        <tr>
                                        <td>{{ $file->documentType->name ?? 'Unknown' }}</td>
                                        <td>{{ $file->original_name }}</td>
                                            <td>{{ $file->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                @if($file->documentScore)
                                                    <span class="badge bg-success">Scored</span>
                                                @else
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($file->memo)
                                                    <span class="text-warning">
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                        {{ $file->memo }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('files.download', $file) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-download"></i> Download
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script>
    Dropzone.options.fileUpload = {
        paramName: "file",
        maxFilesize: 10, // MB
        acceptedFiles: ".pdf,.doc,.docx,.txt",
        init: function() {
            this.on("success", function(file, response) {
                window.location.reload();
            });
        }
    };
</script>
@endpush
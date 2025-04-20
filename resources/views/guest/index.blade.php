@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Your Submissions') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <h5>Upload New Document</h5>
                        <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data" class="dropzone" id="fileUpload">
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

                    <h5>Your Documents</h5>
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
                                            <td>{{ $file->documentType->name }}</td>
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
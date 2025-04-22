<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Scoring - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { background-color: #343a40; }
        .card { 
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05); 
            border: none;
            border-radius: 0.5rem;
        }
        .card-header { 
            background-color: #fff; 
            border-bottom: 1px solid rgba(0,0,0,.05);
            padding: 1.25rem;
        }
        .status-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
        }
        .status-approved { 
            background-color: #dcfce7; 
            color: #166534; 
        }
        .status-rejected { 
            background-color: #fee2e2; 
            color: #991b1b; 
        }
        .status-pending { 
            background-color: #fef3c7; 
            color: #92400e; 
        }
        .document-item {
            transition: all 0.2s ease-in-out;
            border: 1px solid rgba(0,0,0,.05);
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        .document-item:hover {
            background-color: #f8f9fa;
            transform: translateY(-2px);
        }
        .score-circle {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark mb-4">
        <div class="container">
            <span class="navbar-brand">{{ config('app.name') }} - Project Scoring</span>
            <a href="{{ route('user.home') }}" class="btn btn-outline-light btn-sm">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
        </div>
    </nav>

    <div class="container py-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1 class="h4 mb-0">Project Scoring Details</h1>
                <div class="col-md-4">
                    <select id="project" name="project" class="form-select">
                        <option value="">Choose a project...</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card-body">
                @if(isset($submission))
                    <div class="mb-4 pb-3 border-bottom">
                        <div class="d-flex align-items-center gap-3">
                            <div class="score-circle">
                                {{ $submission->score ?? '-' }}
                            </div>
                            <div>
                                <h2 class="h5 mb-1">Overall Score</h2>
                                <p class="text-muted mb-0">Last updated: {{ $submission->updated_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    @foreach($documentTypes->groupBy('category') as $category => $types)
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-folder text-primary"></i>
                            <h3 class="h5 mb-0">{{ $category }}</h3>
                        </div>

                        <div class="bg-white rounded">
                            @foreach($types as $type)
                                @php
                                    $file = $submission->files->where('document_type_id', $type->id)->first();
                                    $score = $file?->documentScore;
                                @endphp
                                <div class="document-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h4 class="h6 mb-2">{{ $type->name }}</h4>
                                            @if($file)
                                                <div class="d-flex align-items-center gap-3 mb-2">
                                                    @if($file->isApproved())
                                                        <span class="status-badge status-approved">
                                                            <i class="bi bi-check-circle"></i> Approved
                                                        </span>
                                                    @elseif($file->isRejected())
                                                        <span class="status-badge status-rejected">
                                                            <i class="bi bi-x-circle"></i> Rejected
                                                        </span>
                                                    @else
                                                        <span class="status-badge status-pending">
                                                            <i class="bi bi-clock"></i> Pending
                                                        </span>
                                                    @endif
                                                    @if($score)
                                                        <span class="badge bg-secondary">Score: {{ $score->score }}</span>
                                                    @endif
                                                </div>
                                                @if($file->approval_memo)
                                                    <p class="mb-0 small text-muted">
                                                        <i class="bi bi-chat-left-text"></i> {{ $file->approval_memo }}
                                                    </p>
                                                @endif
                                            @else
                                                <p class="mb-0 text-muted">
                                                    <i class="bi bi-exclamation-circle"></i> No document uploaded
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-folder2-open display-4 text-muted mb-3"></i>
                        <p class="text-muted mb-0">Please select a project to view scoring details.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('project').addEventListener('change', function() {
            window.location.href = '{{ route("user.scoring") }}?project_id=' + this.value;
        });
    </script>
</body>
</html>
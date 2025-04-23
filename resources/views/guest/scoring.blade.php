<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Scoring System') }}</title>
    
    <!-- Bootstrap CSS and Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom styles -->
    <style>
        body { background-color: #f8f9fa; }
        .navbar { background-color: #343a40; }
        .card { 
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05); 
            border: none;
            border-radius: 0.5rem;
        }
        .card-header { 
            background-color: #f8f9fa; 
            border-bottom: 1px solid rgba(0,0,0,.05);
            padding: 1.25rem;
        }
        .score-circle {
            width: 50px;
            height: 50px;
            background-color: #4CAF50;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            font-weight: bold;
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
    </style>
</head>
<body>
    <nav class="navbar navbar-dark mb-4">
        <div class="container">
            <span class="navbar-brand">{{ config('app.name') }} - Project Scoring</span>
            <a href="{{ route('guest.index') }}" class="btn btn-outline-light btn-sm">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
        </div>
    </nav>

    <div class="container">
        <!-- Project Selection -->
        <div class="card mb-4">
            <div class="card-body">
                <label for="project" class="form-label">Select Project</label>
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

        @if(isset($submission))
        <!-- Scoring Results -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="card-title h4 mb-0">Project Scoring Details</h2>
                <div class="score-circle">{{ $submission->score ?? '0' }}</div>
            </div>
            <div class="card-body">
                <!-- Document Categories -->
                @foreach($documentTypes->groupBy('category') as $category => $types)
                <div class="mb-4">
                    <h3 class="h5 mb-3 d-flex align-items-center">
                        <i class="bi bi-folder me-2"></i> {{ $category }}
                    </h3>
                    <div class="document-list">
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
                                                <span class="small text-muted">
                                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                                    Score: {{ $score ? $score->score : 'Not scored' }}
                                                </span>
                                            </div>
                                            @if($file->approval_memo)
                                                <p class="small text-muted mb-0">
                                                    <i class="bi bi-chat-left-text me-1"></i>
                                                    {{ $file->approval_memo }}
                                                </p>
                                            @endif
                                        @else
                                            <p class="small text-muted mb-0">
                                                <i class="bi bi-exclamation-circle me-1"></i>
                                                No document uploaded
                                            </p>
                                        @endif
                                    </div>
                                <div>
                                    @if($file && $file->isApproved())
                                        <span class="status-badge status-approved">
                                            <i class="bi bi-check-circle"></i> Approved
                                        </span>
                                    @elseif($file && $file->isRejected())
                                        <span class="status-badge status-rejected">
                                            <i class="bi bi-x-circle"></i> Rejected
                                        </span>
                                    @elseif($file)
                                        <span class="status-badge status-pending">
                                            <i class="bi bi-clock"></i> Pending
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-folder2-open display-4 text-muted mb-3"></i>
            <p class="text-muted mb-0">Please select a project to view scoring details.</p>
        </div>
        @endif
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('project').addEventListener('change', function() {
            window.location.href = '{{ route("guest.scoring") }}?project_id=' + this.value;
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Projects - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-house-door me-1"></i> Dashboard
                </a>
                <h2 class="mb-0">Manage Projects</h2>
            </div>
            <a href="{{ route('projects.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> New Project
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Project Name</th>
                                <th>Pekerjaan</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projects as $project)
                                <tr>
                                    <td class="align-middle">{{ $project->name }}</td>
                                    <td class="align-middle">{{ Str::limit($project->pekerjaan, 50) }}</td>
                                    <td class="align-middle">{{ Str::limit($project->lokasi, 50) }}</td>
                                    <td class="align-middle">
                                        <span class="badge {{ $project->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $project->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="align-middle">{{ $project->created_at->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        <div class="btn-group">
                                            <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-outline-secondary" title="View Details">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-outline-primary" title="Edit Project">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this project?')" title="Delete Project">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-folder-x display-6 d-block mb-3"></i>
                                            No projects found. Create your first project to get started!
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
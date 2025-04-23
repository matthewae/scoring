<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('User Dashboard') }} - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; padding-left: 0; transition: padding-left 0.3s ease; }
        body.sidebar-expanded { padding-left: 250px; }
        .navbar { background-color: #343a40; }
        .card { box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); }
        .card-header { background-color: #f8f9fa; border-bottom: 1px solid rgba(0,0,0,.125); }
        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            transition: left 0.3s ease;
            z-index: 1000;
            padding-top: 1rem;
        }
        .sidebar.expanded { left: 0; }
        .sidebar-link {
            display: block;
            padding: 0.75rem 1.25rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: background-color 0.2s ease;
        }
        .sidebar-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: #fff;
        }
        .sidebar-link.active {
            background-color: rgba(255,255,255,0.2);
            color: #fff;
        }
        .toggle-sidebar {
            cursor: pointer;
            padding: 0.5rem;
            margin-right: 1rem;
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="d-flex justify-content-between align-items-center px-3 mb-3">
            <h5 class="text-light mb-0">{{ config('app.name') }}</h5>
            <button class="btn btn-link text-light p-0 d-md-none" onclick="toggleSidebar()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <a href="{{ route('user.index') }}" class="sidebar-link{{ Request::routeIs('user.index') ? ' active' : '' }}">
            {{ __('Dashboard') }}
        </a>
        <a href="{{ route('user.scoring') }}" class="sidebar-link{{ Request::routeIs('user.scoring') ? ' active' : '' }}">
            {{ __('Project Scoring') }}
        </a>
    </div>

    <nav class="navbar navbar-expand-md navbar-dark mb-4">
        <div class="container">
            <button class="btn btn-link text-light p-0 toggle-sidebar" onclick="toggleSidebar()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
            <div class="d-flex">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">{{ __('Logout') }}</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="card-header">{{ __('Project Scoring Dashboard') }}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Guest Project Submissions') }}</h5>
                        <p class="card-text">{{ __('Review and score pending project submissions from guests.') }}</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ __('Pending Assistance Requests') }}</span>
                        <span class="badge bg-primary">{{ count($assistanceRequests ?? []) }} {{ __('Pending') }}</span>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ __('Review and manage guest assistance requests.') }}</p>
                        @if(count($assistanceRequests ?? []) > 0)
                            <div class="list-group">
                                @foreach($assistanceRequests as $request)
                                    <div class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1">{{ __('Request from Guest') }} #{{ $request->id }}</h6>
                                                <p class="mb-1">{{ $request->description }}</p>
                                                @if($request->submission && $request->submission->project)
                                                    <div class="text-muted small">
                                                        <i class="bi bi-folder"></i> {{ __('Project') }}: {{ $request->submission->project->name }}
                                                    </div>
                                                @endif
                                            </div>
                                            <span class="badge bg-secondary">{{ $request->created_at->diffForHumans() }}</span>
                                        </div>
                                        <form method="POST" action="{{ route('user.accept-request', $request->id) }}" class="mt-2">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">{{ __('Accept Request') }}</button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">{{ __('No pending assistance requests.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('input[type="radio"][name="score"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const memoField = this.closest('form').querySelector('.memo-field');
                const memoTextarea = memoField.querySelector('textarea');
                if (this.value === '0') {
                    memoField.style.display = 'block';
                    memoTextarea.required = true;
                } else {
                    memoField.style.display = 'none';
                    memoTextarea.required = false;
                }
            });
        });

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const body = document.body;
            sidebar.classList.toggle('expanded');
            body.classList.toggle('sidebar-expanded');
        }

        // Handle responsive behavior
        const mediaQuery = window.matchMedia('(min-width: 768px)');
        function handleViewportChange(e) {
            const sidebar = document.getElementById('sidebar');
            const body = document.body;
            if (e.matches) {
                sidebar.classList.add('expanded');
                body.classList.add('sidebar-expanded');
            } else {
                sidebar.classList.remove('expanded');
                body.classList.remove('sidebar-expanded');
            }
        }
        mediaQuery.addListener(handleViewportChange);
        handleViewportChange(mediaQuery);
    </script>
</body>
</html>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">{{ __('Submission Management') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h5 class="card-title">{{ __('Review and Score Submissions') }}</h5>
                    <p class="card-text">{{ __('Manage project submissions and provide scoring feedback.') }}</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">{{ __('Pending Submissions') }}</div>
                <div class="card-body">
                    @if(count($pendingSubmissions) > 0)
                        <div class="list-group">
                            @foreach($pendingSubmissions as $submission)
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ __('Submission') }} #{{ $submission->id }}</h6>
                                        <small>{{ $submission->created_at->format('Y-m-d H:i') }}</small>
                                    </div>
                                    <p class="mb-1">
                                        <strong>{{ __('Files') }}:</strong>
                                        @foreach($submission->files as $file)
                                            <br>- {{ $file->original_name }} ({{ number_format($file->file_size / 1024, 2) }} KB)
                                        @endforeach
                                    </p>
                                    <div class="d-flex gap-2 mt-2">
                                        <a href="{{ route('user.submissions.download', $submission) }}" class="btn btn-secondary btn-sm">
                                            {{ __('Download Files') }}
                                        </a>
                                    </div>
                                    <form method="POST" action="{{ route('user.submissions.score', $submission) }}" class="mt-3">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="score" class="form-label">{{ __('Score (0-100)') }}</label>
                                            <input type="number" class="form-control" id="score" name="score" min="0" max="100" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="feedback" class="form-label">{{ __('Feedback') }}</label>
                                            <textarea class="form-control" id="feedback" name="feedback" rows="3" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm">{{ __('Submit Score') }}</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">{{ __('No pending submissions to review.') }}</p>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Recent Scored Submissions') }}</div>
                <div class="card-body">
                    @if(count($scoredSubmissions) > 0)
                        <div class="list-group">
                            @foreach($scoredSubmissions as $submission)
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ __('Submission') }} #{{ $submission->id }}</h6>
                                        <small>{{ $submission->updated_at->format('Y-m-d H:i') }}</small>
                                    </div>
                                    <p class="mb-1"><strong>{{ __('Score') }}:</strong> {{ $submission->score }}/100</p>
                                    <p class="mb-1"><strong>{{ __('Feedback') }}:</strong></p>
                                    <p class="mb-1">{{ $submission->feedback }}</p>
                                    <p class="mb-1">
                                        <strong>{{ __('Files') }}:</strong>
                                        @foreach($submission->files as $file)
                                            <br>- {{ $file->original_name }}
                                        @endforeach
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">{{ __('No scored submissions found.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
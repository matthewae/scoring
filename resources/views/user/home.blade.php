@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">{{ __('User Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h5 class="card-title">{{ __('Construction Project Scoring System') }}</h5>
                    <p class="card-text">{{ __('Manage project submissions and scoring as an authorized user.') }}</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">{{ __('File Upload') }}</div>
                <div class="card-body">
                    <p class="card-text">{{ __('Upload project files for scoring.') }}</p>
                    <form method="POST" action="{{ route('user.upload') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="projectFiles" class="form-label">{{ __('Project Files') }}</label>
                            <input type="file" class="form-control" id="projectFiles" name="projectFiles[]" multiple required>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Upload Files') }}</button>
                    </form>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">{{ __('Pending Assistance Requests') }}</div>
                <div class="card-body">
                    <p class="card-text">{{ __('Review and manage guest assistance requests.') }}</p>
                    @if(count($assistanceRequests ?? []) > 0)
                        <div class="list-group">
                            @foreach($assistanceRequests as $request)
                                <div class="list-group-item">
                                    <h6 class="mb-1">{{ __('Request from Guest') }} #{{ $request->id }}</h6>
                                    <p class="mb-1">{{ $request->description }}</p>
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

            <div class="card">
                <div class="card-header">{{ __('Guest Submissions Review') }}</div>
                <div class="card-body">
                    <p class="card-text">{{ __('Review and score guest project submissions.') }}</p>
                    @if(count($pendingScores ?? []) > 0)
                        <div class="list-group">
                            @foreach($pendingScores as $submission)
                                <div class="list-group-item">
                                    <h6 class="mb-1">{{ __('Project Submission') }} #{{ $submission->id }}</h6>
                                    <div class="mb-3">
                                        <a href="{{ route('user.submissions.download', $submission->id) }}" class="btn btn-secondary btn-sm">
                                            {{ __('Download Files') }}
                                        </a>
                                    </div>
                                    <form method="POST" action="{{ route('user.submissions.score', $submission->id) }}" class="mt-2">
                                        @csrf
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="score" id="approve{{ $submission->id }}" value="1" required>
                                                <label class="form-check-label" for="approve{{ $submission->id }}">
                                                    {{ __('Approve') }}
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="score" id="reject{{ $submission->id }}" value="0">
                                                <label class="form-check-label" for="reject{{ $submission->id }}">
                                                    {{ __('Reject') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3 memo-field" style="display: none;">
                                            <label for="memo" class="form-label">{{ __('Rejection Memo') }}</label>
                                            <textarea class="form-control" id="memo" name="memo" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm">{{ __('Submit Review') }}</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
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
                        </script>
                    @else
                        <p class="text-muted">{{ __('No pending submissions to review.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
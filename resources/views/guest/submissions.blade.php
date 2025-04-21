@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">{{ __('My Submissions') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h5 class="card-title">{{ __('Track Your Project Submissions') }}</h5>
                    <p class="card-text">{{ __('View the status and scores of your submitted projects.') }}</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Submission History') }}</div>
                <div class="card-body">
                    @if(count($submissions ?? []) > 0)
                        <div class="list-group">
                            @foreach($submissions as $submission)
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ __('Submission') }} #{{ $submission->id }}</h6>
                                        <small>{{ $submission->created_at->format('Y-m-d H:i') }}</small>
                                    </div>
                                    <p class="mb-1">
                                        <strong>{{ __('Status') }}:</strong>
                                        @if($submission->score !== null)
                                            @if($submission->score == 1)
                                                <span class="badge bg-success">{{ __('Approved') }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ __('Rejected') }}</span>
                                            @endif
                                        @else
                                            <span class="badge bg-warning text-dark">{{ __('Pending Review') }}</span>
                                        @endif
                                    </p>
                                    @if($submission->score !== null)
                                        <div class="mt-2">
                                            <p class="mb-1">
                                                <strong>{{ __('Review Result') }}:</strong>
                                                {{ $submission->score == 1 ? __('Your submission has been approved.') : __('Your submission has been rejected.') }}
                                            </p>
                                            @if($submission->score == 0 && $submission->memo)
                                                <div class="alert alert-info mt-2">
                                                    <strong>{{ __('Rejection Memo') }}:</strong>
                                                    <p class="mb-0">{{ $submission->memo }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    <p class="mb-1">
                                        <strong>{{ __('Files') }}:</strong>
                                        @foreach($submission->files as $file)
                                            <br>- {{ $file->original_name }}
                                            <a href="{{ route('files.download', $file) }}" class="btn btn-link btn-sm">
                                                {{ __('Download') }}
                                            </a>
                                        @endforeach
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">{{ __('No submissions found.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
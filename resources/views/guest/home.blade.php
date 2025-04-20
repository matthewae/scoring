@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">{{ __('Guest Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h5 class="card-title">{{ __('Welcome to the Construction Project Scoring System') }}</h5>
                    <p class="card-text">{{ __('Please choose how you would like to submit your project files for scoring:') }}</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">{{ __('Self Upload') }}</div>
                <div class="card-body">
                    <p class="card-text">{{ __('Upload your project files directly for scoring.') }}</p>
                    <form method="POST" action="{{ route('guest.submissions.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="projectFiles" class="form-label">{{ __('Project Files') }}</label>
                            <input type="file" class="form-control" id="projectFiles" name="projectFiles[]" multiple required>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Upload Files') }}</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Request User Assistance') }}</div>
                <div class="card-body">
                    <p class="card-text">{{ __('Request a user to handle the file upload and scoring process for you.') }}</p>
                    <form method="POST" action="{{ route('guest.request-assistance') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="projectDescription" class="form-label">{{ __('Project Description') }}</label>
                            <textarea class="form-control" id="projectDescription" name="description" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-secondary">{{ __('Request Assistance') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
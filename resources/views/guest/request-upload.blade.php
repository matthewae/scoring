@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Request Document Upload') }}</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('guest.upload.request') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="project_name" class="form-label">{{ __('Project Name') }}</label>
                            <input type="text" class="form-control @error('project_name') is-invalid @enderror" 
                                    id="project_name" name="project_name" required 
                                    value="{{ old('project_name') }}">
                            @error('project_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="document_types" class="form-label">{{ __('Required Document Types') }}</label>
                            <select class="form-select @error('document_types') is-invalid @enderror" 
                                    id="document_types" name="document_types[]" multiple required>
                                @foreach($documentTypes as $type)
                                    <option value="{{ $type->id }}" 
                                            {{ (old('document_types') && in_array($type->id, old('document_types'))) ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('document_types')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">{{ __('Hold Ctrl/Cmd to select multiple document types') }}</div>
                        </div>

                        <div class="mb-3">
                            <label for="deadline" class="form-label">{{ __('Preferred Deadline') }}</label>
                            <input type="date" class="form-control @error('deadline') is-invalid @enderror" 
                                    id="deadline" name="deadline" required 
                                    value="{{ old('deadline') }}">
                            @error('deadline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="special_requirements" class="form-label">{{ __('Special Requirements or Notes') }}</label>
                            <textarea class="form-control @error('special_requirements') is-invalid @enderror" 
                                        id="special_requirements" name="special_requirements" rows="4"
                                        placeholder="{{ __('Please describe any special requirements or additional information needed for your documents.') }}">{{ old('special_requirements') }}</textarea>
                            @error('special_requirements')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contact_email" class="form-label">{{ __('Contact Email') }}</label>
                            <input type="email" class="form-control @error('contact_email') is-invalid @enderror" 
                                    id="contact_email" name="contact_email" required 
                                    value="{{ old('contact_email') }}">
                            @error('contact_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('guest.index') }}" class="btn btn-secondary">
                                {{ __('Back to Dashboard') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit Request') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
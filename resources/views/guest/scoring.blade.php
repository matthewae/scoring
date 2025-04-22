@extends('layouts.scoring')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <!-- Project Selection -->
        <div class="mb-8">
            <label for="project" class="block text-sm font-medium text-gray-700 mb-2">Select Project</label>
            <select id="project" name="project" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="">Choose a project...</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
        </div>

        @if(isset($submission))
        <!-- Scoring Results -->
        <div class="space-y-6">
            <div class="border-b border-gray-200 pb-4">
                <h2 class="text-lg font-medium text-gray-900">Project Scoring Details</h2>
                <p class="mt-1 text-sm text-gray-500">Overall Score: {{ $submission->score ?? 'Not scored yet' }}</p>
            </div>

            <!-- Document Categories -->
            @foreach($documentTypes->groupBy('category') as $category => $types)
            <div class="mt-6">
                <h3 class="text-md font-medium text-gray-900 mb-4">{{ $category }}</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="space-y-4">
                        @foreach($types as $type)
                            @php
                                $file = $submission->files->where('document_type_id', $type->id)->first();
                                $score = $file?->documentScore;
                            @endphp
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900">{{ $type->name }}</h4>
                                    @if($file)
                                        <p class="text-sm text-gray-500">
                                            Status: {{ ucfirst($file->approval_status) }}
                                            @if($score)
                                                | Score: {{ $score->score }}
                                            @endif
                                        </p>
                                        @if($file->approval_memo)
                                            <p class="text-sm text-gray-500">Note: {{ $file->approval_memo }}</p>
                                        @endif
                                    @else
                                        <p class="text-sm text-gray-500">No document uploaded</p>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    @if($file && $file->isApproved())
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Approved
                                        </span>
                                    @elseif($file && $file->isRejected())
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Rejected
                                        </span>
                                    @elseif($file)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <p class="text-gray-500">Please select a project to view scoring details.</p>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('project').addEventListener('change', function() {
        window.location.href = '{{ route("guest.scoring") }}?project_id=' + this.value;
    });
</script>
@endpush
@endsection
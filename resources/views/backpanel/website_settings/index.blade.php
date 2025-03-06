@extends('backpanel.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 text-white">{{ isset($settings) ? 'Update Website Settings' : 'Create Website Settings' }}</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('backpanel.website.settings.save') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="web_name" class="form-label">Website Name</label>
                    <input type="text" class="form-control" id="web_name" name="web_name" value="{{ $settings->web_name ?? '' }}" required>
                </div>

                <div class="mb-4">
                    <label for="web_logo" class="form-label">Website Logo</label>
                    <input type="file" class="form-control" id="web_logo" name="web_logo">
                    @if(isset($settings->web_logo))
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $settings->web_logo) }}" alt="Logo" width="100" class="img-thumbnail">
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="web_favicon" class="form-label">Favicon</label>
                    <input type="file" class="form-control" id="web_favicon" name="web_favicon">
                    @if(isset($settings->web_favicon))
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $settings->web_favicon) }}" alt="Favicon" width="50" class="img-thumbnail">
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="web_description" class="form-label">Website Description</label>
                    <textarea class="form-control" id="web_description" name="web_description" rows="3" required>{{ $settings->web_description ?? '' }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="web_meta_title" class="form-label">Meta Title</label>
                    <input type="text" class="form-control" id="web_meta_title" name="web_meta_title" value="{{ $settings->web_meta_title ?? '' }}" required>
                </div>

                <div class="mb-4">
                    <label for="web_meta_keywords" class="form-label">Meta Keywords</label>
                    <input type="text" class="form-control" id="web_meta_keywords" name="web_meta_keywords" value="{{ $settings->web_meta_keywords ?? '' }}">
                </div>

                <div class="mb-4">
                    <label for="web_meta_description" class="form-label">Meta Description</label>
                    <textarea class="form-control" id="web_meta_description" name="web_meta_description" rows="3">{{ $settings->web_meta_description ?? '' }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="web_google_analytics" class="form-label">Google Analytics</label>
                    <textarea class="form-control" id="web_google_analytics" name="web_google_analytics" rows="2">{{ $settings->web_google_analytics ?? '' }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="web_facebook_pixel" class="form-label">Facebook Pixel</label>
                    <textarea class="form-control" id="web_facebook_pixel" name="web_facebook_pixel" rows="2">{{ $settings->web_facebook_pixel ?? '' }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="web_header_script" class="form-label">Header Script</label>
                    <textarea class="form-control" id="web_header_script" name="web_header_script" rows="3">{{ $settings->web_header_script ?? '' }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="web_footer_script" class="form-label">Footer Script</label>
                    <textarea class="form-control" id="web_footer_script" name="web_footer_script" rows="3">{{ $settings->web_footer_script ?? '' }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="web_og_image" class="form-label">OG Image</label>
                    <input type="file" class="form-control" id="web_og_image" name="web_og_image">
                    @if(isset($settings->web_og_image))
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $settings->web_og_image) }}" alt="OG Image" width="100" class="img-thumbnail">
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="web_status" class="form-label">Status</label>
                    <select class="form-select" id="web_status" name="web_status" required>
                        <option value="1" {{ isset($settings) && $settings->web_status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ isset($settings) && $settings->web_status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4">{{ isset($settings) ? 'Update Settings' : 'Create Settings' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

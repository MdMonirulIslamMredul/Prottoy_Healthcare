@extends('backend.layouts.app')

@section('title', 'Website Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Website Logos & Favicon</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Website Settings</li>
                        <li class="breadcrumb-item active">Logos & Favicon</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-image me-2"></i>Edit Website Assets
                    </h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('superadmin.website.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="header_logo" class="form-label">Header Logo</label>
                            <input type="file"
                                   class="form-control @error('header_logo') is-invalid @enderror"
                                   id="header_logo"
                                   name="header_logo"
                                   accept="image/*">
                            @error('header_logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($settings && $settings->header_logo)
                                <div class="mt-3">
                                    <img src="{{ Storage::url($settings->header_logo) }}" alt="Header Logo" class="img-fluid" style="max-height: 100px;">
                                </div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="footer_logo" class="form-label">Footer Logo</label>
                            <input type="file"
                                   class="form-control @error('footer_logo') is-invalid @enderror"
                                   id="footer_logo"
                                   name="footer_logo"
                                   accept="image/*">
                            @error('footer_logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($settings && $settings->footer_logo)
                                <div class="mt-3">
                                    <img src="{{ Storage::url($settings->footer_logo) }}" alt="Footer Logo" class="img-fluid" style="max-height: 100px;">
                                </div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="favicon" class="form-label">Favicon</label>
                            <input type="file"
                                   class="form-control @error('favicon') is-invalid @enderror"
                                   id="favicon"
                                   name="favicon"
                                   accept="image/*">
                            @error('favicon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($settings && $settings->favicon)
                                <div class="mt-3 d-flex align-items-center gap-3">
                                    <img src="{{ Storage::url($settings->favicon) }}" alt="Favicon" class="img-fluid" style="max-height: 48px; width: auto;">
                                    <span class="text-muted">Current favicon</span>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i>Update Website Assets
                            </button>
                            <a href="{{ route('superadmin.dashboard') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-1"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-info-circle me-2"></i>Guidelines
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6 class="alert-heading">Upload Recommendations</h6>
                        <ul class="mb-0 ps-3">
                            <li>Header and footer logos should be transparent PNG or SVG for best results.</li>
                            <li>Favicon should be square and optimized for web.</li>
                            <li>Max file size is 2MB for logos and 1MB for favicon.</li>
                        </ul>
                    </div>

                    @if($settings)
                        <div class="alert alert-success">
                            <h6 class="alert-heading"><i class="bi bi-check-circle me-1"></i>Current assets</h6>
                            <p class="mb-1"><strong>Header logo:</strong> {{ $settings->header_logo ? 'Uploaded' : 'Not set' }}</p>
                            <p class="mb-1"><strong>Footer logo:</strong> {{ $settings->footer_logo ? 'Uploaded' : 'Not set' }}</p>
                            <p class="mb-0"><strong>Favicon:</strong> {{ $settings->favicon ? 'Uploaded' : 'Not set' }}</p>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <h6 class="alert-heading"><i class="bi bi-exclamation-triangle me-1"></i>No assets found</h6>
                            <p class="mb-0">Upload your logo files and favicon to start using website branding settings.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

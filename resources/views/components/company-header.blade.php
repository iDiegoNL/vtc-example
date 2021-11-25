@props([
    'company',
])

@push('scripts-top')
    @if($company->cover_image_path)
        <style>
            .breadcrumbs-v1 {
                height: 350px;
                background: url({{ asset($company->cover_image_path) }}) center no-repeat !important;
                background-size: cover !important;
            }
        </style>
    @endif
@endpush

<div class="breadcrumbs-v1 text-center hidden-sm hidden-xs">
    <div class="container" style="position: relative; top: 150px; left: -10px; z-index: 1">
        <div class="row">
            <div class="col-lg-2 col-md-3">
                <a href="{{ route('vtc.show', $company->id) }}">
                    <img src="{{ asset($company->logo_path) }}" alt="{{ $company->name }}'s logo"
                         class="{{ $company->logo_border ? 'rounded-circle' : 'rounded-circle-no-border' }} animated fadeInLeft dropshadow">
                </a>
            </div>
            <div class="col-lg-10 col-md-9">
                <div class="text-left animated fadeInLeft dropshadow">
                    <h2 style="font-size: 30px; display: inline-block; margin: 3px 0; padding: .7rem; background: rgba(0, 0, 0, 0.7)"
                        class="break-all">
                        {{ $company->name }}
                    </h2>
                    <br>
                    <h4 style="font-size: 16px; display: inline-block; margin-top: 2px; padding: .7rem; background: rgba(0, 0, 0, 0.7)">
                        {{ $company->slogan }}
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="margin-top: 60px"></div>

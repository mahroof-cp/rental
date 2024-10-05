@section('title','Add Services')

@push('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendor/libs/select2/select2.css')}}">
<link rel="stylesheet" href="{{asset('vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
<link rel="stylesheet" href="{{asset('vendor/libs/quill/typography.css')}}" />
<link rel="stylesheet" href="{{asset('vendor/libs/quill/editor.css')}}" />
@endpush

@push('vendor-script')
<script src="{{asset('vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}" class="validation-script"></script>
<script src="{{asset('vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
<script src="{{asset('vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
<script src="{{asset('vendor/libs/quill/katex.js')}}"></script>
<script src="{{asset('vendor/libs/quill/quill.htmlEditButton.min.js')}}"></script>
<script src="{{asset('vendor/libs/quill/quill.js')}}"></script>
@endpush

@push('style')
<link rel="stylesheet" href="{{asset('css/admin/services/addServices.css')}}">
@endpush

@push('script')
<script src="{{asset('js/admin/services/facility/addFacility.js')}}"></script>
@endpush

<x-admin-layout>

    <x-breadcrumbs :breadcrumbs="$breadcrumbs">
    </x-breadcrumbs>

    <div class="card">
        <div class="card-body">
            <form id="servicesForm" class="mb-3" action="{{ route('admin_facility_savefacility') }}"
            method="POST">
            @csrf
            <input type="hidden" name="services_id" id="services_id" value="{{ $services->id }}">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <label for="title_en" class="mandatory form-label">@lang('Title (English)')</label>
                    <input type="text" value="{{ old('title_en') }}" class="form-control"
                        name="title_en" id="title_en">
                    @error('title_en')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="title_ar" class="mandatory form-label">@lang('Title (Arabic)')</label>
                    <input type="text" value="{{ old('title_ar') }}" class="form-control"
                        name="title_ar" id="title_ar">
                    @error('title_ar')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col m6 s12">
                    <label for="html_en" class="active form-label"> Description (English) </label>
                    <textarea hidden class="description" name="html_en" id="html_en">{!! old('html_en') !!}</textarea>
                    <div class="quill-editor">{!! old('html_en') !!}</div>
                    @error('html_en')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col m6 s12">
                    <label for="html_ar" class="active form-label"> Description (Arabic) </label>
                    <textarea hidden class="description" name="html_ar" id="html_ar">{!! old('html_ar') !!}</textarea>
                    <div class="quill-editor">{!! old('html_ar') !!}</div>
                    @error('html_ar')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <label for="icon" class="mandatory form-label">@lang('Icon')</label>
                    <input type="text" value="{{ old('icon') }}" class="form-control"
                        name="icon" id="icon">
                    @error('icon')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="status">
                        @lang('Status')<span class="red-text">*</span>
                    </label>
                    <br>
                    <div class="form-check form-check-inline mt-3">
                        <input class="form-check-input" type="radio" name="status" value="1"
                            checked />
                        <label class="form-check-label">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" value="0" />
                        <label class="form-check-label">Inactive</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 display-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-success float-end ms-2">Create</button>
                    <a href="{{ route('admin_cms_list') }}" class="btn btn-primary float-end">Cancel</a>
                </div>
            </div>
        </form>
        </div>
    </div>
</x-admin-layout>
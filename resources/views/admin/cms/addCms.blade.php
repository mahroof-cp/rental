@section('title','Add Cms')

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
<link rel="stylesheet" href="{{asset('css/admin/cms/addCms.css')}}">
@endpush

@push('script')
<script src="{{asset('js/admin/cms/addCms.js')}}"></script>
@endpush

<x-admin-layout>

    <x-breadcrumbs :breadcrumbs="$breadcrumbs">
    </x-breadcrumbs>

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin_cms_save')}}" id="cmsForm" class="mb-3" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <label for="name" class="mandatory form-label">@lang('Cms Name') <span class="red-text">*</span></label>
                        <small class="form-text">Slug will be created from Cms Name</small>
                        <input type="text" value="{{old('name')}}" class="form-control" name="name" id="name">
                        @error('name')<small class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label class="active">Select Category <span class="red-text">*</span></label>
                        <select data-option-url="{{route('admin_options_cms_categories')}}" class="select2-ajax" name="cms_category_id" id="cms_category_id" data-error="#cms_category_id-error-div" data-placeholder="Select category">
                        </select>
                        @error('cms_category_id')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
                        <div id="cms_category_id-error-div"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <label for="title_en" class="mandatory form-label">@lang('Cms Title (English)')</label>
                        <input type="text" value="{{old('title_en')}}" class="form-control" name="title_en" id="title_en">
                        @error('title_en')<small class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label for="title_ar" class="mandatory form-label">@lang('Cms Title (Arabic)')</label>
                        <input type="text" value="{{old('title_ar')}}" class="form-control" name="title_ar" id="title_ar">
                        @error('title_ar')<small class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control" type="file" id="file" name="file">
                        @error('file')<small class="form-text text-danger red-text">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label for="formFile" class="form-label">Thumbnail</label>
                        <input class="form-control" type="file" id="thumbnail" name="thumbnail">
                        @error('thumbnail')<small class="form-text text-danger red-text">{{ $message }}</small>@enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col m6 s12">
                        <label for="html_en" class="active form-label"> Content (English) </label>
                        <textarea hidden class="description" name="html_en" id="html_en">{!! old('html_en') !!}</textarea>
                        <div class="quill-editor">{!! old('html_en') !!}</div>
                        @error('html_en')<small class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col m6 s12">
                        <label for="html_ar" class="active form-label"> Content (Arabic) </label>
                        <textarea hidden class="description" name="html_ar" id="html_ar">{!! old('html_ar') !!}</textarea>
                        <div class="quill-editor">{!! old('html_ar') !!}</div>
                        @error('html_ar')<small class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 display-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-success float-end ms-2">Create</button>
                        <a href="{{route('admin_cms_list')}}" class="btn btn-primary float-end">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
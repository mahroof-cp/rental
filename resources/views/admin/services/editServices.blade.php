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
<link rel="stylesheet" href="{{asset('css/admin/services/editServices.css')}}">
@endpush

@push('script')
<script src="{{asset('js/admin/services/editServices.js')}}"></script>
@endpush

<x-admin-layout>

    <x-breadcrumbs :breadcrumbs="$breadcrumbs">
    </x-breadcrumbs>

    <div class="card">

    
        <div class="card-body">
            <form action="{{route('admin_services_update')}}" id="serviceeditForm" class="mb-3" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id" value="{{$services->id}}">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <label for="name_en" class="mandatory form-label">@lang('Name (English)')</label>
                        <input type="text" value="{{old('name', $services->name_en)}}" class="form-control" name="name_en" id="name_en">
                        @error('name_en')<small class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label for="name_ar" class="mandatory form-label">@lang('Name (Arabic)')</label>
                        <input type="text" value="{{old('name', $services->name_ar)}}" class="form-control" name="name_ar" id="name_ar">
                        @error('name_ar')<small class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col m6 s12">
                        <label for="html_en" class="active"> Description (English) </label>
                        <textarea class="hide description" hidden name="html_en" id="html_en">{!! old('html_en', $services->description_en) !!}</textarea>
                        <div class="quill-editor">{!! old('html_en', $services->description_en) !!}</div>
                        @error('html_en')<small class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col m6 s12">
                        <label for="html_ar" class="active"> Description (Arabic) </label>
                        <textarea class="hide description" hidden name="html_ar" id="html_ar">{!! old('html_ar', $services->description_ar) !!}</textarea>
                        <div class="quill-editor">{!! old('html_ar', $services->description_ar) !!}</div>
                        @error('html_ar')<small class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        @if($services->image && Storage::disk('rentel')->exists($services->image))
                        <div>
                            <label class="active" for="file">Image</label>
                            <img class="preview" src="{{Storage::disk('rentel')->url($services->image)}}" alt="" width="150px">
                            <a href="{{route('admin_services_remove_file',['id'=>$services->id, 'field' => 'image'])}}" class="confirm-delete text-danger">
                                <i class="material-icons pink-text">clear</i>
                            </a>
                        </div>
                        @else
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control" type="file" id="file" name="file">
                        @error('file')<small class="form-text text-danger red-text">{{ $message }}</small>@enderror
                        @endif
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label for="status">
                            @lang('Status')<span class="red-text">*</span>
                        </label>
                        <br>
                        <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="status" value="1" {{$services->status ? "checked" : ""}} />
                            <label class="form-check-label">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" value="0" {{!$services->status ? "checked" : ""}} />
                            <label class="form-check-label">Inactive</label>
                        </div>
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
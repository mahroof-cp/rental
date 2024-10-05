@section('title','Edit Cms')

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
<link rel="stylesheet" href="{{asset('css/admin/cms/editCms.css')}}">
@endpush

@push('script')
<script src="{{asset('js/admin/cms/editCms.js')}}"></script>
@endpush

<x-admin-layout>

    <x-breadcrumbs :breadcrumbs="$breadcrumbs">
    </x-breadcrumbs>

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin_cms_update')}}" id="cmsForm" class="mb-3" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="{{$cms->id}}">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <label for="name" class="mandatory form-label">@lang('Cms Name') <span class="red-text">*</span></label>
                        <small class="form-text">Slug will be created from Cms Name</small>
                        <input type="text" value="{{old('name', $cms->name)}}" class="form-control" name="name" id="name">
                        @error('name')<small class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label class="active">Select Category <span class="red-text">*</span></label>
                        <select data-option-url="{{route('admin_options_cms_categories')}}" class="select2-ajax" name="cms_category_id" id="cms_category_id" data-error="#cms_category_id-error-div" data-placeholder="Select category">
                            @if($cms->category)
                            <option id="{{$cms->cms_category_id}}" selected>{{$cms->category->name}}</option>
                            @endif
                        </select>
                        @error('cms_category_id')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
                        <div id="cms_category_id-error-div"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <label for="title_en" class="mandatory">@lang('Cms Title (English)')</label>
                        <input type="text" value="{{old('title_en', $cms->title_en)}}" class="form-control" name="title_en" id="title_en">
                        @error('title_en')<small class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label for="title_ar" class="mandatory">@lang('Cms Title (Arabic)')</label>
                        <input type="text" value="{{old('title_ar', $cms->title_ar)}}" class="form-control" name="title_ar" id="title_ar">
                        @error('title_ar')<small class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        @if($cms->file && Storage::disk('rentel')->exists($cms->file))
                        <div>
                            <label class="active" for="file">Image</label>
                            <img class="preview" src="{{Storage::disk('rentel')->url($cms->file)}}" alt="" width="150px">
                            <a href="{{route('admin_cms_remove_file',['id'=>$cms->id, 'field' => 'file'])}}" class="confirm-delete text-danger">
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
                        @if($cms->thumbnail && Storage::disk('rentel')->exists($cms->thumbnail))
                        <div>
                            <label class="active" for="thumbnail">Thumbnail</label>
                            <img class="preview" src="{{Storage::disk('rentel')->url($cms->thumbnail)}}" alt="" width="150px">
                            <a href="{{route('admin_cms_remove_file',['id'=>$cms->id, 'field' => 'thumbnail'])}}" class="confirm-delete text-danger">
                                <i class="material-icons pink-text">clear</i>
                            </a>
                        </div>
                        @else
                        <label for="formFile" class="form-label">Thumbnail</label>
                        <input class="form-control" type="file" id="thumbnail" name="thumbnail">
                        @error('thumbnail')<small class="form-text text-danger red-text">{{ $message }}</small>@enderror
                        @endif
                    </div>
                    @if($cms->is_deletable)
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <label for="status">
                                @lang('Status')<span class="red-text">*</span>
                            </label>
                            <br>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="radio" name="status" value="1" {{$cms->status ? "checked" : ""}} />
                                <label class="form-check-label">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" value="0" {{!$cms->status ? "checked" : ""}} />
                                <label class="form-check-label">Inactive</label>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="row justify-content-md-center">
                    <div class="col m6 s12">
                        <label for="html_en" class="active"> Content (English) </label>
                        <textarea class="hide description" hidden name="html_en" id="html_en">{!! old('html_en', $cms->html_en) !!}</textarea>
                        <div class="quill-editor">{!! old('html_en', $cms->html_en) !!}</div>
                        @error('html_en')<small class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col m6 s12">
                        <label for="html_ar" class="active"> Content (Arabic) </label>
                        <textarea class="hide description" hidden name="html_ar" id="html_ar">{!! old('html_ar', $cms->html_ar) !!}</textarea>
                        <div class="quill-editor">{!! old('html_ar', $cms->html_ar) !!}</div>
                        @error('html_ar')<small class="form-text text-danger">{{ $message }}</small>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 display-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-success float-end ms-2">Update</button>
                        <a href="{{route('admin_cms_list')}}" class="btn btn-primary float-end">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
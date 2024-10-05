@section('title','Edit Banner')

@push('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendor/libs/select2/select2.css')}}">
<link rel="stylesheet" href="{{asset('vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endpush

@push('style')
<link rel="stylesheet" href="{{asset('css/admin/banner/editBanner.css')}}">
@endpush

@push('vendor-script')
<script src="{{asset('vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}" class="validation-script"></script>
<script src="{{asset('vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
<script src="{{asset('vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
@endpush

@push('script')
<script src="{{asset('js/admin/banner/editBanner.js')}}"></script>
@endpush

<x-admin-layout>

    <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin_banner_update')}}" method="post" enctype="multipart/form-data" id="bannerForm">
                <input type="hidden" name="id" value="{{$banner->id}}">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <label for="name"> @lang('Name') <span class="red-text">*</span> </label>
                        <input type="text" value="{{old('name', $banner->name)}}" class="form-control" name="name" id="name">
                        @error('name')<small class="form-text red-text text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <label for="formFile" class="form-label">Images</label>
                                <input class="form-control" type="file" id="file" name="file[]">
                                @error('file')<small class="form-text text-danger red-text">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-xs-12 col-md-12">
                                @if($banner->items)
                                @foreach($banner->items as $item)
                                @if($item->file && Storage::disk('rentel')->exists($item->file))
                                <div class="col l12 m12">
                                    <div class="row mb-1">
                                        <div class="col-md-2 pl-0">
                                            <img class="preview" src="{{Storage::disk('rentel')->url($item->file)}}" alt="" style="width:100%">
                                        </div>
                                        <div class="col-md-9 p-0">
                                            <div class="row justify-content-md-center">
                                                <div class="input-field col-md-6 s12">
                                                    <input type="text" name="title_en[{{$item->id}}]" value="{{$item->title_en}}" placeholder="Please enter title (English)">
                                                </div>
                                                <div class="input-field col-md-6 s12">
                                                    <input type="text" name="title_ar[{{$item->id}}]" value="{{$item->title_ar}}" placeholder="Please enter title (Arabic)">
                                                </div>
                                            </div>
                                            <div class="row justify-content-md-center">
                                                <div class="input-field col-md-6 s12">
                                                    <textarea name="description_en[{{$item->id}}]" class="materialize-textarea" placeholder="Please enter description (English)">{{$item->description_en}}</textarea>
                                                </div>
                                                <div class="input-field col-md-6 s12">
                                                    <textarea name="description_ar[{{$item->id}}]" class="materialize-textarea" placeholder="Please enter description (Arabic)">{{$item->description_ar}}</textarea>
                                                </div>
                                            </div>
                                            <!-- <input type="text" name="link[{{$item->id}}]" value="{{$item->link}}" placeholder="Please enter link"> -->
                                            <input type="hidden" name="files[{{$item->id}}]" value="{{$item->file}}">
                                        </div>
                                        <div class="col-md-1 pr-0">
                                            <a href="{{route('admin_banner_remove_file',['id'=>$banner->id, 'item_id' => $item->id])}}" class="confirm-delete text-red">
                                                <i class="material-icons pink-text float-right">clear</i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                <input type="hidden" name="hasCover" value="true">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <label for="status">
                            @lang('Status')<span class="red-text">*</span>
                        </label>
                        <br>
                        <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="status" value="1" {{$banner->status ? "checked" : ""}} />
                            <label class="form-check-label">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" value="0" {{!$banner->status ? "checked" : ""}} />
                            <label class="form-check-label">Inactive</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 display-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-success float-end ms-2">Update</button>
                        <a href="{{route('admin_banner_list')}}" class="btn btn-primary float-end">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
@section('title', 'Settings')

@push('vendor-style')
<link rel="stylesheet" href="{{asset('vendor/libs/quill/typography.css')}}" />
<link rel="stylesheet" href="{{asset('vendor/libs/quill/editor.css')}}" />
@endpush

@push('style')
<link rel="stylesheet" href="{{asset('css/admin/settings/viewSettings.css')}}">
@endpush

@push('vendor-script')
<script src="{{asset('vendor/libs/quill/katex.js')}}"></script>
<script src="{{asset('vendor/libs/quill/quill.htmlEditButton.min.js')}}"></script>
<script src="{{asset('vendor/libs/quill/quill.js')}}"></script>
@endpush

@push('script')
<script src="{{asset('js/admin/settings/viewSettings.js')}}"></script>
@endpush

<x-admin-layout>

    <x-breadcrumbs :breadcrumbs="$breadcrumbs">
    </x-breadcrumbs>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">@lang('General')</h5>

                <form action="{{route('admin_settings_general_save')}}" method="post" enctype='multipart/form-data'>
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="company_name_en">@lang('Company Name (English)')</label>
                            <input type="text" value="{{ old('company_name_en',$settings->get('company_name_en')->value) }}" name="company_name_en" id="company_name_en" class="form-control">
                            @error('company_name_en')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="company_name_ar">@lang('Company Name (Arabic)')</label>
                            <input type="text" value="{{ old('company_name_ar',$settings->get('company_name_ar')->value) }}" name="company_name_ar" id="company_name_ar" class="form-control">
                            @error('company_name_ar')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="company_description_en">@lang('Company Description (English)')</label>
                            <textarea name="company_description_en" id="company_description_en" class="form-control">{!! old('company_description_en',$settings->get('company_description_en')->value) !!}</textarea>
                            @error('company_description_en')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="company_description_ar">@lang('Company Description (Arabic)')</label>
                            <textarea name="company_description_ar" id="company_description_ar" class="form-control">{!! old('company_description_ar',$settings->get('company_description_ar')->value) !!}</textarea>
                            @error('company_description_ar')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            @if($settings->get('fav_icon')->value && Storage::disk('rentel')->exists($settings->get('fav_icon')->value))
                            <label for="fav_icon" class="active">@lang('Fav Icon')</label>
                            <img class="preview favicon_preview" src="{{Storage::disk('rentel')->url($settings->get('fav_icon')->value)}}" alt="" style="width:auto; max-width:40px;">
                            <a href="{{route('admin_settings_remove_favicon')}}" class="confirm-delete text-danger"><i class="material-icons dp48">close</i></a>
                            @else
                            <label for="fav_icon" class="active">@lang('Fav Icon')</label>
                            <input class="form-control" type="file" id="fav_icon" name="fav_icon">
                            @endif
                            @error('fav_icon')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            @if($settings->get('logo_dark')->value && Storage::disk('rentel')->exists($settings->get('logo_dark')->value))
                            <label for="logo_dark" class="active">@lang('Dark Logo')</label>
                            <img class="preview" src="{{Storage::disk('rentel')->url($settings->get('logo_dark')->value)}}" alt="" style="width:150px">
                            <a href="{{route('admin_settings_remove_dark_logo')}}" class="confirm-delete text-danger"><i class="material-icons dp48">close</i></a>
                            @else
                            <label for="logo_dark" class="active">@lang('Dark Logo')</label>
                            <input class="form-control" type="file" id="logo_dark" name="logo_dark">
                            @endif
                            @error('logo_dark')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            @if($settings->get('logo_light')->value && Storage::disk('rentel')->exists($settings->get('logo_light')->value))
                            <label for="logo_light" class="active">@lang('Light Logo')</label>
                            <img class="preview" src="{{Storage::disk('rentel')->url($settings->get('logo_light')->value)}}" alt="" style="width:150px">
                            <a href="{{route('admin_settings_remove_light_logo')}}" class="confirm-delete text-danger"><i class="material-icons dp48">close</i></a>
                            @else
                            <label for="logo_light" class="active">@lang('Light Logo')</label>
                            <input class="form-control" type="file" id="logo_light" name="logo_light">
                            @endif
                            @error('logo_light')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="meta_tags">@lang('Meta Tags')</label>
                            <textarea name="meta_tags" id="meta_tags" class="form-control">{!! old('meta_tags',$settings->get('meta_tags')->value) !!}</textarea>
                            @error('meta_tags')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="address">@lang('Address')</label>
                            <textarea name="address" id="address" class="form-control">{!! old('address',$settings->get('address')->value) !!}</textarea>
                            @error('address')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="email">@lang('Email')</label>
                            <input type="email" value="{{ old('email',$settings->get('email')->value) }}" name="email" id="email" class="form-control">
                            @error('email')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone">@lang('Phone')</label>
                            <input type="text" value="{{ old('phone',$settings->get('phone')->value) }}" name="phone" id="phone" class="form-control">
                            @error('phone')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success float-end ms-2 mb-3">SAVE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">@lang('Google Map')</h5>

                <form action="{{route('admin_settings_general_save')}}" method="post" enctype='multipart/form-data'>
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="google_map_api_key">@lang('Google Map Api Key')</label>
                            <input type="text" value="{{ old('google_map_api_key',$settings->get('google_map_api_key')->value) }}" name="google_map_api_key" id="google_map_api_key" class="form-control">
                            @error('google_map_api_key')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success float-end ms-2 mb-3">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">@lang('External Links')</h5>

                <form action="{{route('admin_settings_general_save')}}" method="post" enctype='multipart/form-data'>
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="facebook_url">@lang('Facebook')</label>
                            <input type="text" value="{{ old('facebook_url',$settings->get('facebook_url')->value) }}" name="facebook_url" id="facebook_url" class="form-control">
                            @error('facebook_url')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="twitter_url">@lang('Twitter')</label>
                            <input type="text" value="{{ old('twitter_url',$settings->get('twitter_url')->value) }}" name="twitter_url" id="twitter_url" class="form-control">
                            @error('twitter_url')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="youtube_url">@lang('Youtube')</label>
                            <input type="text" value="{{ old('youtube_url',$settings->get('youtube_url')->value) }}" name="youtube_url" id="youtube_url" class="form-control">
                            @error('youtube_url')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="instagram_url">@lang('Instagram')</label>
                            <input type="text" value="{{ old('instagram_url',$settings->get('instagram_url')->value) }}" name="instagram_url" id="instagram_url" class="form-control">
                            @error('instagram_url')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success float-end ms-2 mb-3">SAVE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
@extends('layouts.contentLayoutMaster')

@push('style')
<link rel="stylesheet" href="{{mix('css/admin/settings/link.css')}}">
@endpush

@push('script')
<script src="{{mix('js/admin/settings/link.js')}}"></script>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <form action="{{route('admin_settings_link_save')}}" method="post">
            @csrf
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4>@lang('External Links')</h4>
                </div>
                <div class="card-body">


                    <div class="row justify-content-md-center">
                        <div class="form-group col-md-6">
                            <label for="facebook_url">@lang('Facebook')</label>
                            <input type="text" value="{{old('facebook_url',$settings->get('facebook_url')->value)}}" name="facebook_url" id="facebook_url" class="form-control" placeholder="@lang('Facebook')">
                            @error('facebook_url')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="twitter_url">@lang('Twitter')</label>
                            <input type="text" value="{{old('twitter_url',$settings->get('twitter_url')->value)}}" name="twitter_url" id="twitter_url" class="form-control" placeholder="@lang('Twitter')">
                            @error('twitter_url')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="form-group col-md-6">
                            <label for="pinterest_url">@lang('Pinterest')</label>
                            <input type="text" value="{{old('pinterest_url',$settings->get('pinterest_url')->value)}}" name="pinterest_url" id="pinterest_url" class="form-control" placeholder="@lang('Pinterest')">
                            @error('pinterest_url')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="linkedin_url">@lang('Linkedin')</label>
                            <input type="text" value="{{old('linkedin_url',$settings->get('linkedin_url')->value)}}" name="linkedin_url" id="linkedin_url" class="form-control" placeholder="@lang('Linkedin')">
                            @error('linkedin_url')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="form-group col-md-6">
                            <label for="youtube_url">@lang('Youtube')</label>
                            <input type="text" value="{{old('youtube_url',$settings->get('youtube_url')->value)}}" name="youtube_url" id="youtube_url" class="form-control" placeholder="@lang('Youtube')">
                            @error('youtube_url')<small class="form-text text-danger">{{ $message }}</small>@enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-sm btn-primary">@lang('SAVE')</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
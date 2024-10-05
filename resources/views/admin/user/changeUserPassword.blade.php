@section('title','Change Password')

@push('style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/users/changeUserPassword.css')}}">
@endpush

@push('vendor-script')
    <script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endpush

@push('script')
    <script src="{{asset('js/admin/users/changeUserPassword.js')}}"></script>
@endpush

<x-admin-layout>

    <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>

{{-- Page Content --}}
<!-- Form Advance -->
    <div class="container">
        <div id="Form-advance" class="card card-default scrollspy">
            <div class="card-content">
                <div class="row p-3">
                    <div class="col-md-8 offset-md-2">
                        <form method="POST" id="userPasswordForm" action="{{route('admin_user_update_password')}}">
                            <input type="hidden" value="{{ auth()->user()->id }}" name="id">
                            @csrf
                            <div class="form-group">
                                <label for="current">Current Password <span class="text-danger">*</span></label>
                                <input id="current" name="current" type="password" class="form-control">
                                @error('current')<small class="form-text text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input id="password" name="password" type="password" class="form-control">
                                @error('password')<small class="form-text text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirm">Confirm Password <span class="text-danger">*</span></label>
                                <input id="password_confirm" name="password_confirm" type="password" class="form-control">
                                @error('password_confirm')<small class="form-text text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="row p-3">
                                <div class="col-md-12 text-right p-2">
                                    <a href="{{route("admin_dashboard")}}" class="btn btn-light mr-2">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>

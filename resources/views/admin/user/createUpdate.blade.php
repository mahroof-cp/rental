@section('page_title', empty($obj->id) ? 'Add User' : 'Update User')
@section('title', empty($obj->id) ? 'New User' : 'Update User')

<x-admin-layout>
    <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>
    <div class="row">
        <div class="col-8">
            <h3 class="card-title">
                @yield('page_title')
            </h3>
        </div>
        <div class="col-4 d-flex justify-content-end">
            <div class="card-tools">
                <a href="{{ route('admin_user_index') }}" class="btn waves-effect waves-light btn-primary">
                    <i class="fa fa-chevron-left aut"></i> Back </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
                <form id="form" method="post" action="{{ route('admin_user_create_update_post') }}" autocomplete="off"
                      novalidate="novalidate">
                    @csrf
                    <input type="hidden" name="id" value="{{ empty($obj->id) ? 0 : $obj->id }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form-control-border" id="name" name="name" placeholder="Enter Name"
                                   value="{{ old('name', $obj->name) }}" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-border" id="email" name="email" placeholder="Enter Email"
                                   value="{{ old('email', $obj->email) }}" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="role_id">Role</label>
                            <select class="form-select" id="role_id" name="role_id">
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" @if(old('role_id', $obj->role_id) == $role->id) selected @endif>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-border" id="password" name="password"
                                   placeholder="Password">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control form-control-border" name="password_confirmation"
                                   id="password_confirmation" placeholder="Confirm Password" equalTo="#password"
                                   autocomplete="new-cf-password">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-secondary">{{ empty($obj->id) ? 'Submit' : 'Update' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>

@section('style')
@endsection

@section('head-script')
@endsection

@section('script')
@endsection

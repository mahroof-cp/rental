@section('page_title', empty($obj->id) ? 'Add Role' : 'Update Role')
@section('title', empty($obj->id) ? 'New Role' : 'Update Role')

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
                <a href="{{ route('admin_role_index') }}" class="btn waves-effect waves-light btn-primary">
                    <i class="fa fa-chevron-left aut"></i> Back </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
                <form id="form" method="post" action="{{ route('admin_role_create_update_post') }}" autocomplete="off"
                      novalidate="novalidate">
                    @csrf
                    <input type="hidden" name="id" value="{{ empty($obj->id) ? 0 : $obj->id }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Role Name</label>
                            <input type="text" class="form-control form-control-border" id="name" name="name"
                                   value="{{ old('name', $obj->name) }}" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="permissions">Permission</label>
                            <div class="select2-primary">
                                <select class="custom-select form-control-border select2 select2-danger" id="permissions" name="permissions[]"
                                        multiple="multiple">
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->id }}" @if(in_array($permission->id, $permissions_selected)) selected @endif>{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
    <script type="text/javascript">
        $("#permissions").select2({
            multiple: true
        });
    </script>
@endsection

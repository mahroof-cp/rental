@section('page_title', empty($obj->id) ? 'Add Bank' : 'Update Bank')
@section('title', empty($obj->id) ? 'New Bank' : 'Update Bank')

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
                <a href="{{ route('admin_bank_index') }}" class="btn waves-effect waves-light btn-primary">
                    <i class="fa fa-chevron-left aut"></i> Back </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
                <form id="form" method="post" action="{{ route('admin_bank_create_update_post') }}" autocomplete="off"
                      novalidate="novalidate">
                    @csrf
                    <input type="hidden" name="id" value="{{ empty($obj->id) ? 0 : $obj->id }}">
                    <div class="card-body">
                        @if(!empty($obj->id))
                            <div class="form-group">
                                <label for="name">Unique ID</label>
                                <input type="text" class="form-control form-control-border" id="unique_id"
                                       value="{{ $obj->unique_id }}" readonly>
                            </div>
                            <br>
                        @endif
                        <div class="form-group">
                            <label for="name">Bank Name</label>
                            <input type="text" class="form-control form-control-border" id="name" name="name"
                                   value="{{ old('name', $obj->name) }}" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control form-control-border" rows="5" id="description"
                                      name="description">{{ old('description', $obj->description) }}</textarea>
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

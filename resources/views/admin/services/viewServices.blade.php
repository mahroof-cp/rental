@section('title', 'View Services Facility')

@push('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/libs/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/quill/editor.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
@endpush

@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/users/editUser.css') }}">
@endpush

@push('vendor-script')
    <script src="{{ asset('vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}" class="validation-script">
    </script>
    <script src="{{ asset('vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ asset('vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('vendor/libs/quill/quill.htmlEditButton.min.js') }}"></script>
    <script src="{{ asset('vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('vendor/libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
    <script src="{{ asset('vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
@endpush

@push('script')
    <script src="{{ asset('js/admin/services/viewServices.js') }}"></script>
@endpush

<x-admin-layout>

    <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>

    {{-- Page Content --}}
    <!-- Form Advance -->
    <div class="row">
        <div class="col-12 mb-4">
            <small class="text-light fw-semibold">Basic</small>
            <div class="bs-stepper formwizard mt-2">
                <div class="bs-stepper-header">
                    <div class="step" data-target="#view-service">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">View Services</span>
                            </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#account-details">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">View Services-Facility</span>
                            </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#change-password">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Add Services-facility</span>
                            </span>
                        </button>
                    </div>
                    <div class="line"></div>
                </div>
                <div class="bs-stepper-content">
                    <div id="view-service" class="content">
                        <div class="card">
                            <div class="card-content">
                                <div class="row m-2">
                                    <div class="col s6 input-field">
                                        <input type="hidden" id="services_id" value="{{$services->services_id}}">
                                        <div class="col  s12">
                                            <label class="fw-bold">Name (English)</label>
                                        </div>
                                        <div class="col s12">
                                            {{ $services->name_en }}
                                        </div>
                                    </div>
                                    <div class="col s6 input-field">
                                        <div class="col s12">
                                            <label class="fw-bold">Name (Arabic)</label>
                                        </div>
                                        <div class="col s12">
                                            {{ $services->name_ar }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-2 mt-5">
                                    <div class="col s6 input-field">
                                        <div class="col s12">
                                            <label class="fw-bold"> Description (English)</label>
                                        </div>
                                        <div class="col s12">
                                            {{ $services->description_en }}
                                        </div>
                                    </div>
                                    <div class="col s6 input-field">
                                        <div class="col s6">
                                            <label class="fw-bold"> Description (Arabic)</label>
                                        </div>
                                        <div class="col s6">
                                            {{ $services->description_ar }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-2 mt-5">
                                    <div class="col s6">
                                        <div class="col s12">
                                            <label>Image</label>
                                        </div>
                                        <div class="col s12">
                                            <img class="preview" src="{{Storage::disk('rentel')->url($services->image)}}" alt="" width="100px">
                                        </div>
                                    </div>
                                <div class="col s6 input-field">
                                    <div class="col s6">
                                        <div class="switch">
                                            <label for="status" class="fw-bold">
                                                @lang('Status')
                                            </label>
                                            <label>
                                                <span>{{ $services->status ? 'Active' : 'Inactive' }}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="account-details" class="content">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form id="servicesFilterAttribute" class="searchform" class="searchform">
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <label for="select2Basic" class="form-label">Status</label>
                                        <select class="select2 form-select form-select-lg" id="services-status">
                                            <option value="">All</option>
                                            <option value="0">Inactive</option>
                                            <option value="1">Active</option>
                                        </select>
                                    </div>
                                    <div class="show-btn">
                                        <button type="submit"
                                            class="waves-effect waves dark btn btn-primary">Show</button>
                                        <button class="red btn btn-danger reset_search ">Reset</button>
                                        <a class="btn waves-effect waves-light btn-info" href="{{route('admin_facility_addfacility')}}">
                                            <i class='bx bx-plus'></i><span class="hide-on-small-onl">Add</span>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-datatable text-nowrap">
                            <table class="datatables-ajax table table-bordered" id="servicesFacilityList" class="table"
                                data-url="{{ route('admin_facility_tablefacility') }}">
                                <thead>
                                    <tr>
                                        <th width="1">#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="change-password" class="content">
                    <form id="servicehours" class="mb-3" action="{{ route('admin_facility_savehoursfacility') }}"
                        method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="mon" class="mandatory form-label">@lang('Monday')</label>
                                <input type="text" value="{{ old('mon') }}" class="form-control"
                                    name="mon" id="mon">
                                @error('mon')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="tus" class="mandatory form-label">@lang('Teusday')</label>
                                <input type="text" value="{{ old('tus') }}" class="form-control"
                                    name="tus" id="tus">
                                @error('tus')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="wed" class="mandatory form-label">@lang('Wednesday')</label>
                                <input type="text" value="{{ old('wed') }}" class="form-control"
                                    name="wed" id="wed">
                                @error('wed')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="thur" class="mandatory form-label">@lang('Thursday')</label>
                                <input type="text" value="{{ old('thur') }}" class="form-control"
                                    name="thur" id="thur">
                                @error('thur')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="fri" class="mandatory form-label">@lang('Friday')</label>
                                <input type="text" value="{{ old('fri') }}" class="form-control"
                                    name="fri" id="fri">
                                @error('fri')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="sat" class="mandatory form-label">@lang('saturday')</label>
                                <input type="text" value="{{ old('sat') }}" class="form-control"
                                    name="sat" id="sat">
                                @error('sat')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <label for="sun" class="mandatory form-label">@lang('Sunday')</label>
                                <input type="text" value="{{ old('sun') }}" class="form-control"
                                    name="sun" id="sun">
                                @error('sun')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 display-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success float-end ms-2">Create</button>
                                <a href="{{ route('admin_cms_list') }}" class="btn btn-primary float-end">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-admin-layout>

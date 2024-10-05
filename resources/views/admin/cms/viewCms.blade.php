@section('title','View category')

@push('vendor-style')
@endpush

@push('style')
<link rel="stylesheet" href="{{asset('css/admin/category/viewCategory.css')}}">
@endpush

@push('vendor-script')
@endpush

@push('script')
<script src="{{asset('js/admin/category/viewCategory.js')}}"></script>
@endpush

<x-admin-layout>

    <x-breadcrumbs :breadcrumbs="$breadcrumbs"></x-breadcrumbs>

    <div class="col s12">
        <div class="container">
            {{-- Content --}}
            <div class="section">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12">
                                <ul class="stepper" id="categoryStepper">
                                    <li class="step active">
                                        <div class="step-title waves-effect">General</div>
                                        <div class="step-content">
                                            <div class="row justify-content-md-center">
                                                <div class="input-field col m6 s12">
                                                    <label class="active" for="division_id">
                                                        @lang('Division')
                                                    </label>
                                                    <label>
                                                        <span>{{ $category->division->name }} </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row justify-content-md-center">
                                                <div class="input-field col m6 s12">
                                                    <div>
                                                        <label class="active" for="file">@lang('Logo')</label>
                                                        @if(Storage::disk('rentel')->exists($category->logo))
                                                        <img class="preview" src="{{Storage::disk('rentel')->url($category->logo)}}" alt="" width="150px">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="input-field col m6 s12">
                                                    <div>
                                                        <label class="active" for="file">@lang('Icon')</label>
                                                        @if(Storage::disk('rentel')->exists($category->icon))
                                                        <img class="preview" src="{{Storage::disk('rentel')->url($category->icon)}}" alt="" width="150px">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="input-field col m6 s12">
                                                    <div class="switch">
                                                        <label for="status">
                                                            @lang('Status')
                                                        </label>
                                                        <label>
                                                            <span>{{ $category->status ? "Active" : "Inactive" }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="step">
                                        <div class="step-title waves-effect">Attributes</div>
                                        <div class="step-content scroll-bar">
                                            <div class="row justify-content-md-center">
                                                @foreach($selectedAttributes as $attribute)
                                                <div class="input-field col m6 s12">
                                                    <label class="active" for="division_id">
                                                        <?php echo ucwords(str_replace("_", " ", $attribute));  ?>
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>
                                    <li class="step">
                                        <div class="step-title waves-effect">Locale</div>
                                        <div class="step-content scroll-bar">

                                            <ul class="collapsible popout" id="categoryLocaleCollapsible">
                                                @foreach($languages as $language)
                                                <li @if($loop->first) class="active" @endif>
                                                    <div class="collapsible-header">
                                                        @if(Storage::disk('rentel')->exists($language->flag))
                                                        <img class="preview" src="{{Storage::disk('rentel')->url($language->flag)}}" alt="" width="20px">
                                                        @endif
                                                        {{$language->name . ' (' . $language->code . ')'}}
                                                    </div>
                                                    <div class="collapsible-body">
                                                        <div class="row justify-content-md-center">
                                                            <div class="input-field col m12 s12">
                                                                <div class="col s12">
                                                                    <label for="locale[{{$language->id}}][name]" class="mandatory">
                                                                        @lang('Name')
                                                                    </label>
                                                                </div>
                                                                <div class="col s12">
                                                                    <label>
                                                                        <span>{{ !isset($category->locale[$language->id]) ? '' : $category->locale[$language->id]->name }} </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
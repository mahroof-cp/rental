@if(isset($data['view_url']) && $data['view_url'])
<a class="view-list" href="{{$data['view_url']}}">
    <i class="menu-icon tf-icons bx bx-show"></i>
</a>
@endif
@if(isset($data['edit_url']) && $data['edit_url'])
<a href="{{$data['edit_url']}}">
    <i class="menu-icon tf-icons bx bx-pencil"></i>
</a>
@endif
@if(isset($data['delete_url']) && $data['delete_url'])
<a class="delete-list" href="javascript:void(0)" data-src="{{$data['delete_url']}}">
    <i class="menu-icon tf-icons bx bx-trash"></i>
</a>
@endif
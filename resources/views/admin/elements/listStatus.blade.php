@if($data['status'] == 0)
<span class="chip red lighten-5 update-list-status" data-url="{{isset($data['url']) ? $data['url'] : ''}}" data-id="{{$data['id']}}">
    <span class="red-text">Inactive</span>
</span>
@endif
@if($data['status'] == 1)
<span class="chip green lighten-5 update-list-status" data-url="{{isset($data['url']) ? $data['url'] : ''}}" data-id="{{$data['id']}}">
    <span class="green-text">Active</span>
</span>
@endif
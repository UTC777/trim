@foreach ($upfiles as $item)
<div class="media-item" id="media-item-{{$item->id}}">
    <img class="thump" src="{{$item->getUrl()}}" alt="">
    <div class="filename">{{$item->file_name}}</div>
</div>
@endif
@endforeach
@foreach ($upfiles as $item)
<li class="" role="checkbox" data-id="{{$item->id}}" aria-checked="true" id="attachment-item-{{$item->id}}">
    <span class="tooltiptextimg" id="myTooltipName{{$item->id}}">{{ $item->file_name }}</span>
    <div class="check"><div class="media-icon"></div></div>
    <div class="delete" id="{{$item->id}}"  title="Delete"><div class="media-icon"></div></div>
    <div class="copy-link" id="{{$item->id}}" link="{{$item->getUrl()}}"  title="Copy Image Link"><span class="tooltiptext" id="myTooltip{{ $item->id }}">Copy to clipboard</span><div class="media-icon"></div></div>
    <div class="attachment-preview">
        <div class="thumbnail-item"><img src="{{ $item->getUrl() }}" /></div>
    </div>
</li>
@endforeach
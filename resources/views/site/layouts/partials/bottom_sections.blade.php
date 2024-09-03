@if($bottom_sections)
@foreach($bottom_sections as $bs)
    @if ($bs->location=='page_bottom')
        {!! $bs->section !!}
    @endif
@endforeach
@endif

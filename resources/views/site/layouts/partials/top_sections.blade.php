@if($top_sections)
@foreach($top_sections as $ts)
    @if ($ts->location=='page_top')
        {!! $ts->section !!}
    @endif
@endforeach
@endif

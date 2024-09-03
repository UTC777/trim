@can($viewGate)
    @if ($crudRoutePart == 'products')
        @php
            $url = url('products/' . $row->slug);
        @endphp
        <a class="btn btn-xs btn-primary" target="_blank" href="{{ $url }}">
            {{ trans('global.view') }}
        </a>
    @elseif ($crudRoutePart == 'posts')
        @php
            $url = url('blog/' . $row->slug);
        @endphp
        <a class="btn btn-xs btn-primary" target="_blank" href="{{ $url }}">
            {{ trans('global.view') }}
        </a>
    @elseif ($crudRoutePart == 'content-pages')
        @if ($row->is_homepage == 1)
            @php
                $url = url('');
            @endphp
        @else
            @if ($row->path_segments == 0)
                @php
                    $url = url($row->slug);
                @endphp
            @elseif ($row->path_segments == 1)
                @php
                    $url = url($row->path . '/' . $row->slug);
                @endphp
            @elseif ($row->path_segments == 2)
                @php
                    $url = url($row->path . '/' . $row->path2 . '/' . $row->slug);
                @endphp
            @elseif ($row->path_segments == 3)
                @php
                    $url = url($row->path . '/' . $row->path2 . '/' . $row->path3 . '/' . $row->slug);
                @endphp
            @elseif ($row->path_segments == 4)
                @php
                    $url = url($row->path . '/' . $row->path2 . '/' . $row->path3 . '/' . $row->path4 . '/' . $row->slug);
                @endphp
            @endif
        @endif


        <a class="btn btn-xs btn-primary" href="{{ $url }}" target="_blank">
            {{ trans('global.view') }}
        </a>
    @else
        <a class="btn btn-xs btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
            {{ trans('global.view') }}
        </a>
    @endif
@endcan
@can($editGate)
    <a class="btn btn-xs btn-info" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
        {{ trans('global.edit') }}
    </a>
@endcan
@can($deleteGate)
    <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST"
        onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
    </form>
@endcan

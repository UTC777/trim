@foreach($contentSections as $key => $contentSection)
<tr data-entry-id="{{ $contentSection->id }}">
    <td>
        <input type="hidden" class="ContentSectionOrders" name="ContentSectionOrders[]" value="{{ $contentSection->id }}"> 
    </td>
    <th>
        <input type="checkbox" disabled {{ ($contentSection->published ? 'checked' : null) }}>
    </th>
    <td>
        {{ $contentSection->section_title ?? '' }}
    </td>
    
    <td>
        
        @can('content_section_edit')
            <a class="btn btn-xs btn-info editContentSection" myid="{{ $contentSection->id }}" href="javascript:void(0);">
                <i class="fas fa-edit"></i>
            </a>
        @endcan

        @can('content_section_delete')
            <a class="btn btn-xs btn-danger DeleteContentSectionBtn" myid="{{ $contentSection->id }}" href="javascript:void(0);">
                <i class='fas fa-trash-alt'></i>
            </a>
            @endcan

    </td>

</tr>
@endforeach
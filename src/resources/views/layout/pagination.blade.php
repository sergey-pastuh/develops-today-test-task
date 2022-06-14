@if ($paginator->lastPage() > 1)
<table class="pagination">
    <tr> 
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <td class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </td>
        @endfor
    </tr>
</table>
@endif
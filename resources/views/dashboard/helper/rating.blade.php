@php
    $index=0;
    $loop_pick=0;
    $total = 5;
@endphp
<div class="widget-ratings__star">
    @while($index < $total)
        <i class="zmdi zmdi-star {{ $loop_pick<intval($rating)?'active':'' }}"></i>
        @php
            $index++;
            $loop_pick++;
        @endphp
    @endwhile
</div>'
@if (count($breadcrumbs))
<div class="kt-subheader__breadcrumbs">
@foreach ($breadcrumbs as $breadcrumb)
    @if ($breadcrumb->url && !$loop->last)
    <span class="kt-subheader__breadcrumbs-separator"></span>
        <a href="{{ $breadcrumb->url }}" class="kt-subheader__breadcrumbs-link">{{ $breadcrumb->title }}</a>
    @else
    <span class="kt-subheader__breadcrumbs-separator"></span>
        <a href="" class="kt-subheader__breadcrumbs-link"> {{ $breadcrumb->title }}</a>
    @endif
@endforeach
</div>
@endif


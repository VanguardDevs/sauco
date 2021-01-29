@if (count($breadcrumbs))
<div class="kt-subheader__breadcrumbs">
@foreach ($breadcrumbs as $breadcrumb)
    <span class="kt-subheader__breadcrumbs-separator"></span>
    @if ($breadcrumb->url && !$loop->last)
    <a href="{{ $breadcrumb->url }}" class="kt-subheader__breadcrumbs-link">{{ $breadcrumb->title }}</a>
    @else
    <a href="" class="kt-subheader__breadcrumbs-link"> {{ $breadcrumb->title }}</a>
    @endif
@endforeach
</div>
@endif


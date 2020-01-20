@if (count($breadcrumbs))
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
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
    </div>
  </div>
@endif

{{--<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">

        <h3 class="kt-subheader__title">
            Empty Page                    </h3>

                    <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        General                    </a>
                                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Empty Page                    </a>
                                <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
            </div>

    </div>
</div>--}}


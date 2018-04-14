<div class="ui breadcrumb">
    @foreach ($breadcrumbs as $breadcrumb)
        <a class="section" href="{!! $breadcrumb['url'] !!}">
            {!! $breadcrumb['title'] !!}
        </a>
        <i class="right chevron icon divider"></i>
    @endforeach
</div>
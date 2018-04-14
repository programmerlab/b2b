<div id="modalApprove" class="ui basic modal">
    <div class="image content">
        <div class="ui middle aligned tiny image">
            <i class="trash icon"></i>
        </div>
        <div class="description">
            <div class="ui header large color white">@lang('admin::admin/modal.approve.header')</div>
            <p>@lang('admin::admin/modal.approve.message')</p>
            <p>@lang('admin::admin/modal.approve.status')</p>
        </div>
    </div>
    <div class="actions">
        <div class="two fluid ui inverted buttons">
            <div class="ui red basic cancel inverted button">
                <i class="remove icon"></i> @lang('admin::public.no')
            </div>
            <div class="ui green ok inverted button">
                <i class="checkmark icon"></i> @lang('admin::public.yes')
            </div>
        </div>
    </div>
</div>
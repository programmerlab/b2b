<div class="ui grid">
    <div class="two wide column">
        <div class="field">
            <label for="">Logo</label>
            @include('admin::_parts.image.one', [
                'id'    => str_slug($name.'[logo]'),
                'name'  => $name.'[logo]',
                'value' => isset($val['logo']) ? $val['logo'] : null
            ])
        </div>
    </div>
    <div class="two wide column">
        <div class="field">
            <label for="">Favicon</label>
            @include('admin::_parts.image.one', [
                'id'    => str_slug($name.'[favicon]'),
                'name'  => $name.'[favicon]',
                'value' => isset($val['favicon']) ? $val['favicon'] : null
            ])
        </div>
    </div>
    <div class="twelve wide column">
        <div class="field">
            <label for="">Logo Adı</label>
            <input name="{!! $name !!}[logoName]" value="{!! $val['logoName'] or '' !!}" placeholder="Logo Adı" type="text">
        </div>
        <div class="field">
            <label for="">Slogan</label>
            <input name="{!! $name !!}[slogan]" value="{!! $val['slogan'] or '' !!}" placeholder="Slogan" type="text">
        </div>
    </div>
</div>
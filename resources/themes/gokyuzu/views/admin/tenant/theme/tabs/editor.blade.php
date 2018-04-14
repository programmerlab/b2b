<div class="ui two item menu code-tab">
    <a data-tab="tabEditorCss-{!! $id !!}" class="item active">
        <i class="css3 icon"></i> .css
    </a>
    <a data-tab="tabEditorJs-{!! $id !!}" class="item">
        <i class="code icon"></i> .js
    </a>
</div>
<div class="ui bottom attached tab active" data-tab="tabEditorCss-{!! $id !!}">
    <h3 class="ui header">
        <i class="upload icon"></i>
        <div class="content">
            Yükle
            <div class="sub header">Dışarıdan yüklenecek css linklerinizi, aralarına virgül koyarak ekleyiniz.</div>
        </div>
    </h3>
    <div class="field">
        <div class="ui tag multiple search selection dropdown large">
            <input name="{!! $name !!}[cssImport]" value="{!! $val['cssImport'] or '' !!}" type="hidden">
            <div class="default text">Linkler</div>
            <div class="menu"></div>
        </div>
    </div>
    <h3 class="ui header">
        <i class="code icon"></i>
        <div class="content">
            Kod
            <div class="sub header">Ekstra olarak eklemek istediğiniz css kodları</div>
        </div>
    </h3>
    <div class="ui segment">
        <textarea id="editorCss-{!! $id !!}" data-mode="css" name="{!! $name !!}[cssCode]" class="code mirror">{!! $val['cssCode'] or '' !!}</textarea>
    </div>
</div>
<div class="ui bottom attached tab" data-tab="tabEditorJs-{!! $id !!}">
    <h3 class="ui header">
        <i class="upload icon"></i>
        <div class="content">
            Yükle
            <div class="sub header">Dışarıdan yüklenecek javascript linklerinizi, aralarına virgül koyarak ekleyiniz.</div>
        </div>
    </h3>
    <div class="field">
        <div class="ui tag multiple search selection dropdown large">
            <input name="{!! $name !!}[jsImport]" value="{!! $val['jsImport'] or '' !!}" type="hidden">
            <div class="default text">Linkler</div>
            <div class="menu"></div>
        </div>
    </div>
    <h3 class="ui header">
        <i class="code icon"></i>
        <div class="content">
            Kod
            <div class="sub header">Ekstra olarak eklemek istediğiniz javascript kodları</div>
        </div>
    </h3>
    <div class="ui segment">
        <textarea id="editorJs-{!! $id !!}" data-mode="javascript" name="{!! $name !!}[jsCode]" class="code mirror">{!! $val['jsCode'] or '' !!}</textarea>
    </div>
</div>
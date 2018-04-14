<div class="ui two item menu code-tab">
    <a data-tab="tabEditorCss" class="item active">
        <i class="css3 icon"></i> .css
    </a>
    <a data-tab="tabEditorJs" class="item">
        <i class="code icon"></i> .js
    </a>
</div>
<div class="ui bottom attached tab active" data-tab="tabEditorCss">
    <h3 class="ui header">
        <i class="upload icon"></i>
        <div class="content">
            Yükle
            <div class="sub header">Dışarıdan yüklenecek css linklerinizi, aralarına virgül koyarak ekleyiniz.</div>
        </div>
    </h3>
    <div class="field">
        <div class="ui tag multiple search selection dropdown large">
            <input name="accessory[cssImport]" value="{!! $row['cssImport'] !!}" type="hidden">
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
        <textarea id="editorCss" data-mode="css" name="accessory[cssCode]" class="code mirror">{!! $row['cssCode'] !!}</textarea>
    </div>
</div>
<div class="ui bottom attached tab" data-tab="tabEditorJs">
    <h3 class="ui header">
        <i class="upload icon"></i>
        <div class="content">
            Yükle
            <div class="sub header">Dışarıdan yüklenecek javascript linklerinizi, aralarına virgül koyarak ekleyiniz.</div>
        </div>
    </h3>
    <div class="field">
        <div class="ui tag multiple search selection dropdown large">
            <input name="accessory[jsImport]" value="{!! $row['jsImport'] !!}" type="hidden">
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
        <textarea id="editorJs" data-mode="javascript" name="accessory[jsCode]" class="code mirror">{!! $row['jsCode'] !!}</textarea>
    </div>
</div>
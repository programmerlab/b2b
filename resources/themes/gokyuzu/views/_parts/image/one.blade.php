<div id="{!! $id !!}" class="ui special card no margin top bottom">
    <div class="blurring dimmable image">
        <div class="ui inverted dimmer">
            <div class="content">
                <div class="center">
                    <div onclick="App.modal.filemanager('#{!! $id !!}')" class="ui teal button icon">
                        <i class="refresh icon"></i>
                    </div>
                    <div onclick="App.tool.image.remove('#{!! $id !!}')" class="ui orange button icon">
                        <i class="trash outline icon"></i>
                    </div>
                </div>
            </div>
        </div>
        <img src="{!! !empty($value) ? $value : assets('image/no-image.png') !!}" class="ui big image">
        <input name="{!! $name !!}" value="{!! $value !!}" type="hidden">
    </div>
</div>

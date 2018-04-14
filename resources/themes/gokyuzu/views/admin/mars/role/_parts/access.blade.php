<h3 class="ui top attached header">
    İzinler
</h3>
<div class="ui attached secondary segment">
    <div class="fields two">
        @foreach ($accessFields as $field)
            <div class="field">
                <div class="ui toggle checkbox">
                    <input {!! isset($roleAccess[$field]) && $roleAccess[$field] == 'yes' ? 'checked' : '' !!} type="checkbox" name="access[{!! $field !!}]" placeholder="@lang($pathLang.'.form.'.$field)">
                    <label>@lang($pathLang.'.form.'.$field)</label>
                </div>
            </div>
        @endforeach
    </div>
</div>
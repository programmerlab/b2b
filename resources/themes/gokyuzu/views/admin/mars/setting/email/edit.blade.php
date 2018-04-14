@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('update') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <input name="id" value="{!! $row['id'] !!}" type="hidden">
        <input name="code" value="{!! $row['code'] !!}" type="hidden">
    
        <div class="field">
            <label for="">Host</label>
            <div class="ui left icon input">
                <input name="accessory[host]" value="{{ $row['host'] }}" type="text" placeholder="Host">
                <i class="linkify icon"></i>
            </div>
        </div>
        <div class="field">
            <label for="">Port</label>
            <div class="ui left icon input">
                <input name="accessory[port]" value="{{ $row['port'] }}" type="number" placeholder="Port">
                <i class="sign in icon"></i>
            </div>
        </div>
        <div class="field">
            <label for="">Gönderici Adı</label>
            <div class="ui left icon input">
                <input name="accessory[from_name]" value="{{ $row['from_name'] }}" type="text" placeholder="Gönderici Adı">
                <i class="user icon"></i>
            </div>
        </div>
        <div class="field">
            <label for="">Gönderici Eposta</label>
            <div class="ui left icon input">
                <input name="accessory[from_address]" value="{{ $row['from_address'] }}" type="text" placeholder="Gönderici Eposta">
                <i class="at icon"></i>
            </div>
        </div>
        <div class="field">
            <label for="">Hesap</label>
            <div class="ui left icon input">
                <input name="accessory[username]" value="{{ $row['username'] }}" type="text" placeholder="Hesap">
                <i class="user icon"></i>
            </div>
        </div>
        <div class="field">
            <label for="">Şifre</label>
            <div class="ui left icon input">
                <input name="accessory[password]" value="{{ $row['password'] }}" type="text" placeholder="Şifre">
                <i class="key icon"></i>
            </div>
        </div>
    </form>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function() {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                /**/
            });
        });
    </script>
@stop
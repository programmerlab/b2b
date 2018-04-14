@extends('admin::layout.box')

@section('boxContent')
    <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('add') !!}" class="ui form">
        <div class="ui button submit transition hidden"></div>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">

        <div class="ui grid">
            <div class="two wide column">
                <div class="field">
                    <label for="">Kullanıcı Resmi</label>
                    @include('admin::_parts.image.one', $dataAvatar)
                </div>
            </div>
            <div class="fourteen wide column">
                <div class="field">
                    <label for="">Ad Soyad</label>
                    <input name="name" placeholder="Ad Soyad" type="text">
                </div>
                <div class="field">
                    <label for="">Eposta Adresi</label>
                    <input name="email" placeholder="Eposta Adresi" type="email">
                </div>
                <div class="field">
                    <label for="">Şifre</label>
                    <input name="password" placeholder="Şifre" type="password">
                </div>
            </div>
        </div>
    </form>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function () {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                name: ['empty', 'maxLength[65]'],
                email: ['empty', 'maxLength[96]', 'email'],
                password: ['empty', 'minLength[6]']
            });
        });
    </script>
@stop
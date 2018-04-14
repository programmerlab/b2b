@extends('admin::layout.load_box')

@section('boxBefore')
    @parent
    <section class="box">
        <header>
            <div class="title">
                <i class="icon route method {!! $appRouter['current']['code'] !!}"></i>
                <span>{!! $meta['title'] !!}</span>
            </div>
            <div class="ui icons buttons">
                <div class="ui right pointing dropdown icon button">
                    <i class="settings icon"></i>
                    <div class="menu">
                        @yield('buttonMisc')
                        @include('admin::layout._parts.box.button_misc')
						@if ($appRouter['current']['code'] == 'create' || $appRouter['current']['code'] == 'edit')
							<div onclick="App.modal.close('#modalUrl')" class="ui button icon violet">
								<i class="close icon"></i>
							</div>
						@endif
                    </div>
                </div>
            </div>
        </header>
        <div class="ui content data">
            <form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('add') !!}" class="ui form">
                <div class="ui button submit transition hidden"></div>
                <input name="_token" value="{{ csrf_token() }}" type="hidden">
                <input id="themeName" name="name" value="" type="hidden">
                <input id="tenantId" name="tenant_id" value="{!! tenant('id') !!}" type="hidden">
            </form>
            <div class="ui cards three">
                @foreach($rows as $row)
                    <div class="ui card">
                        <div class="content">
                            <a href="{!! $row['info']['link'] or '' !!}" target="_blank">
                                <img class="right floated mini ui image" src="{!! $row['info']['assets'].'image/author.png' !!}">
                            </a>
                            <div class="header">{!! ucfirst($row['info']['name']) !!}</div>
                            <div class="meta">{!! $row['info']['author'] or '' !!}</div>
                            <div class="description">{!! $row['info']['description'] or '' !!}</div>
                        </div>
                        <div class="image">
                            <img src="{!! $row['info']['preview'] !!}" alt="">
                        </div>
                        <div class="extra content">
                            @if (check_route_access('add'))
                                <a
                                    onclick="componentSubmit('#{!! $appRouter['current']['as'] !!}', '{!! $row['info']['name'] !!}')"
                                    title="{!! $appRouter['methods']['add']['title'] !!}"
                                    class="ui icon button green {!! $appRouter['methods']['add']['method'] !!} fluid">
                                    <i class="icon route method cloud upload"></i>
                                    @lang('admin::public.install')
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@stop

@section('jsCode')
    @parent
    <script>
        $(document).ready(function() {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                /**/
            });

            App.modal.open('#modalUrl', {closable: false});
        });

        function componentSubmit(formId, name) {
            $('#themeName').val(name);
            App.form.submit(formId);
        }
    </script>
@stop

@section('box') @stop
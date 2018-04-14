@extends('admin::layout.main')

@section('main')
    <div class="ui two column grid stackable">
        @foreach($appRouter['childs'] as $child)
            @if (check_role_access_route($child['mainLink']['id']))
                <div class="column">
                    <div class="ui segment">
                        <a href="{!! $child['mainLink']['text']['url'] !!}">
                            <h3 class="ui header grey">
                                <i class="{!! $child['icon'] !!}"></i>
                                <div class="content">
                                    {!! $child['text']['title'] !!}
                                </div>
                            </h3>
                        </a>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@stop
@props(['method' => 'post'])

<form
    method="post"
    @if(!empty($action))
    action="{{ $action }}"
    @endif
    @if (!empty($class))
    class="{{ $class }}"
    @endif
    @if (isset($role))
    role="form"
    @endif
    @if (!empty($novalidate))
    novalidate="{{ $novalidate }}"
    @endif
    @if (!empty($enctype))
    enctype="{{ $enctype }}"
    @endif
    @if (!empty($acceptCharset))
    accept-charset="{{ $acceptCharset }}"
    @endif
    {{--@submit.prevent="{{ $submit }}"--}}
    {{--@keydown="form.errors ? form.errors.clear($event.target.name): null"--}}
    {{ $attributes }}
>
    @csrf
    @method($method)
    {{ $slot }}
</form>

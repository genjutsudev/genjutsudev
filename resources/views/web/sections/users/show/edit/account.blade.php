@props(['user'])

@section('title', 'user')

<x-layouts::users.show.edit>
    <div class="container">
        <div class="row">
            <div class="col">
                {{-- Nickname --}}
                <div class="mb-3">
                    <x-ui.input-form-label>
                        <div class="form-label">Никнейм пользователя</div>
                        <div class="input-group">
                            <x-ui.input-form-control value="{{ urldecode($user->nickname) }}" disabled />
                            <x-ui.a-button-pencil :href="__('/')" />
                        </div>
                    </x-ui.input-form-label>
                </div>
            </div>
            <div class="col">2</div>
        </div>
    </div>
</x-layouts::users.show.edit>

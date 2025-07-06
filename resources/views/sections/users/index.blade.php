@props(['users'])

@section('title', 'Пользователи')

<x-layouts::main>
    <div class="container">
        @foreach($users->items() as $user)
            <div>
                <a
                    href="{{ route('users.show', [$user->nid, $user->profilelink]) }} "
                    class="fw-bold"
                >
                    {{ $user->profilename }}
                </a>
                <small class="text-lowercase">{{ user_last_activity($user) }}</small>
            </div>
        @endforeach
    </div>
</x-layouts::main>

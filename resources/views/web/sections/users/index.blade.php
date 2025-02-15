@props(['users'])

@section('title', 'users')

<x-layouts::main>
    <div class="container">
        @foreach($users->items() as $user)
        <div>
            <a
                href="{{-- {{ route('users.show', [$user->uid, $user->profilelink]) }} --}}"
                class="fw-bold"
            >
                {{ urldecode($user->profilename ?? $user->profilelink) }}
            </a>
            <small class="text-lowercase">{{ $user->lastActivity() }}</small>
        </div>
        @endforeach
    </div>
</x-layouts::main>

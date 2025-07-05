@props(['user'])

@section('title', $user->profilename)

<x-layouts::users-show>
    <h4>Tracked</h4>
    <div>
        content
    </div>
</x-layouts::users-show>

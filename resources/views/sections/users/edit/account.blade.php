@props(['user'])

@section('title', $user->profilename)

<x-layouts::users-edit>
    <div class="container">
        <div class="row">
            <div class="col">1</div>
            <div class="col">2</div>
        </div>
    </div>
</x-layouts::users-edit>

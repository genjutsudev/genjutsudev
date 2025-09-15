@props(['user'])

@section('title', $user->profilename)

@use(\Illuminate\Support\Str)

<x-layouts::users-edit>
    <div @class(['alert', 'alert-warning' => $user->birthday, 'alert-info' => ! $user->birthday, 'd-block'])>
        @if($user->birthday)
            Дата рождения была установлена ранее и не может быть изменена. Текущая дата:
            <b>{{ $user->birthday->isoFormat('D MMMM YYYY') }}</b>
        @else
            Дата рождения может быть установлена единожды. Убедитесь, что выбрали верную дату.
        @endif
    </div>
    <x-ui.form.index method="put" class="w-50">
        {{-- birthday --}}
        <x-ui.form.label required>
            Дата рождения
        </x-ui.form.label>
        <div class="row mb-3">
            {{-- birthday.day --}}
            <div class="col">
                <select id="user_birthday_day" name="user_birthday[day]" class="form-select" required>
                    <option value="" selected disabled>День</option>
                    @for($day = 31; $day >= 1; $day--)
                        <option
                            value="{{ $day }}"
                            @selected($user->birthday?->format('d') == $day)
                        >
                            {{ str_pad($day, 2, '0', STR_PAD_LEFT) }}
                        </option>
                    @endfor
                </select>
            </div>
            {{-- birthday.month --}}
            <div class="col">
                <select id="user_birthday_month" name="user_birthday[month]" class="form-select" required>
                    <option value="" selected disabled>Месяц</option>
                    @for($month = 12; $month >= 1; $month--)
                        <option
                            value="{{ $month }}"
                            @selected($user->birthday?->format('m') == $month)
                        >
                            {{--{{ str_pad($month, 2, '0', STR_PAD_LEFT) }} ---}}
                            {{ Str::title(now()->month($month)->translatedFormat('F')) }}
                        </option>
                    @endfor
                </select>
            </div>
            {{-- birthday.year --}}
            <div class="col">
                <select id="user_birthday_year" name="user_birthday[year]" class="form-select" required>
                    <option value="" selected disabled>Год</option>
                    @for($year = date('Y'); $year >= 1971; $year--)
                        <option
                            value="{{ $year }}"
                            @selected($user->birthday?->format('Y') == $year)
                        >
                            {{ $year }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-12">
                <x-ui.input-errors :messages="$errors->get('user_birthday.day')"/>
            </div>
        </div>
        <div class="form-group text-end">
            <a href="{{ route('users.edit.account', [$user, $user->profilelink]) }}" class="me-2">Отмена</a>
            <input type="submit" value="Сохранить" class="btn btn-primary">
        </div>
    </x-ui.form.index>
</x-layouts::users-edit>

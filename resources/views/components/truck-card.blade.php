@props(['truck' => []])

<div class="card-lift rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
    <div class="flex items-start justify-between">
        <div class="flex items-center gap-3">
            <span class="flex size-11 items-center justify-center rounded-xl bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300">
                <x-icon name="truck" class="size-6" />
            </span>
            <div>
                <h3 class="font-semibold text-slate-900 dark:text-white">{{ $truck['number'] }}</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $truck['route'] }}</p>
            </div>
        </div>
        <x-status-badge :status="$truck['status']" />
    </div>

    <div class="mt-4 flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300">
        <x-icon name="user-group" class="size-4 text-slate-400" />
        {{ $truck['driver'] }}
    </div>

    <div class="mt-4">
        <x-capacity-widget :load="$truck['load']" :capacity="$truck['capacity']" label="Current Load" />
    </div>
</div>
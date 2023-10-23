

<x-layouts.frontend>

    <div class="p-4 text-4xl text-center text-white bg-gray-900">
        <a href="/" class="block">
            {{ $calendar['month'] }} {{ $calendar['year'] }}
        </a>
    </div>

    <div class="mt-8">
        <x-month :weeks="$calendar['weeks']" />
    </div>

</x-layouts.frontend>

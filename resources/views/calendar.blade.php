<x-layouts.frontend>
    @php
        $dayHeading = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    @endphp
    <div class="flex justify-center w-full px-2 md:px-0">
        <div class="block w-full md:w-11/12 2xl:w-9/12">
            <div class="flex justify-center w-full pt-10 xl:pt-20 pb-10">
                <h1 class="font-bold text-2xl md:text-3xl lg:text-4xl text-white">{{ $originDate->format("F Y") }}</h1>
            </div>
            <div class="grid grid-cols-7">
                <div class="col-span-1 text-red-900 py-4">
                    <div class="flex justify-center items-center">
                        <a href="{{ route('calendar', ['month' => $previousMonth, 'year' => $previousYear]) }}"
                           class="underline ">
                            <x-left-arrow/>
                        </a>
                    </div>
                </div>
                <div class="col-span-5 ">
                    <div class="flex h-full items-center justify-center">
                        <a href="{{ route('calendar') }}"
                           class="underline text-accent font-bolde underline-offset-2 font-normal">aktuální měsíc</a>
                    </div>

                </div>
                <div class="col-span-1 py-4">
                    <div class="flex justify-center items-center">
                        <a href="{{ route('calendar', ['month' => $nextMonth, 'year' => $nextYear]) }}"
                           class="underline font-bold">
                            <x-right-arrow/>
                        </a>
                    </div>

                </div>
                @foreach($dayHeading as $day)
                    <div class="col-span-1 text-white text-center py-2">
                        {{ $day }}
                    </div>
                @endforeach

                @foreach($daysInMonth as $day)
                    <div
                        class="col-span-1 border-gray-100 border border-dashed text-white text-center cursor-pointer {{ $day['depressed'] ? 'bg-black/20 text-gray-100/10' : '' }}">
                        @if($day['depressed'])
                            <div
                                class="{{ $day['currentDay'] ? 'bg-accent w-full h-10 flex items-center pt-1  ' : 'h-10 pt-1'  }}">
                                {{ $day['day'] }}
                            </div>
                        @else
                            <div onclick="selectDate('{{$day['date']}}')"
                                 class="{{ $day['currentDay'] ? 'bg-accent w-full h-10  pt-1' : 'h-10 pt-1'  }}">
                                {{ $day['day'] }}
                                @if($day['hasEvents'])
                                    <div class="flex justify-center">
                                        <div class="h-2 w-2 bg-primary rounded-3xl">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                @endforeach
            </div>
            <div id="date-detail" class="flex w-full pb-10 px-4 border-l-[10px] mt-2 border-accent pb-20"
                 style="display: none">
                <p class="text-2xl text-accent py-5"> Události na den: <span id="date-selected-date"></span></p>
                <div class="mt-4 mb-8">
                    <a id="date-add-event"
                       class="px-4 py-2 border border-accent hover:border-white text-white hover:text-accent">nová
                        událost</a>
                </div>
                <div class="grid grid-cols-1" id="date-events">

                </div>
            </div>
            <div class="mb-20"></div>
        </div>
    </div>
    <script>
        let selectedDate;
        const dateDetailEl = document.getElementById('date-detail')
        const dateAddEventEl = document.getElementById('date-add-event')
        const dateEventsEl = document.getElementById('date-events')
        const dateSelectedDateEl = document.getElementById('date-selected-date')
        const selectDate = async (date) => {
            selectedDate = date
            dateSelectedDateEl.innerHTML = date
            const link = `{{ route('event.create') }}?date=${date}`
            dateAddEventEl.setAttribute('href', link)

            const events = await fetch(`{{ route('event.api') }}?date=${date}`)
            const eventsJson = await events.json()
            dateEventsEl.innerHTML = ''
            eventsJson.forEach(event => {
                const eventEl = document.createElement('div')
                eventEl.innerHTML = `
                    <div class="border-l border-accent px-4">
                        <h1 class="text-accent font-main text-2xl "> ${event.title}</h1>
                        <p class="text-white font-main text-xl mt-4">${event.note}</p>
                    </div>`
                dateEventsEl.appendChild(eventEl)
            })

            dateDetailEl.style.display = 'block'
        }
    </script>
</x-layouts.frontend>

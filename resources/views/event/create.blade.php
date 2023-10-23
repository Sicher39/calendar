<x-layouts.frontend>
    <div class="flex justify-center w-full px-2 md:px-0">
        <div class="block w-full md:w-11/12 2xl:w-9/12 mt-10">
            <div class="flex justify-center w-full">
                <div class="block w-full lg:w-10/12 ">
                    <h1 class="text-4xl text-center text-accent font-head mb-10">vložení události</h1>
                    <form action="{{ route('event.store') }}" method="post">
                        @csrf
                        <div class="block space-y-5">
                            <input class="border-white text-white bg-dark w-full border border-dashed py-2 px-4 text-2xl"
                                   type="text" name="title" placeholder="Název ">
                            <div class="flex justify-center">
                                <textarea class="border-white px-4 py-2  text-2xl text-white bg-dark border border-dashed  w-full" name="note"
                                          cols="30" rows="10" placeholder="poznámka"></textarea>
                            </div>
                            <div class="flex-justify-center">
                                <input type="hidden" name="date" value="{{ $date->format('d.m.Y') }}">
                            </div>
                            <div class="flex-justify-center text-center w-full">
                                <button class="px-4 py-2 border border-accent hover:border-white text-white hover:text-accent" type="submit">vložit událost</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.frontend>

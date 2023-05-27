<x-app-layout>


    <section class="bg-cover" style="background-image: url({{ asset('img/home/pexels-clem-onojeghuo-175683.jpg') }})">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-36">

            <div class="w-full md:w-3/4 lg:w-1/2">
                <h1 class="text-white font-bold text-4xl">
                    Parabrisas VIDCLA
                </h1>
                <p class="text-white text-lg mt-2">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit
                    numquam placeat et perspiciatis ipsum,
                    libero molestias ad, quia illo incidunt alias nihil temporibus. Laudantium, fugiat ea sapiente quis
                    blanditiis doloribus.</p>
            </div>

        </div>
    </section>

    <section class="mt-24">
        <h1 class="text-gray-500 text-center text-3xl mb-6">
            CONTENT
        </h1>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-8">
            <article>
                <figure>
                    <img class="rounded-xl h-36 w-full object-cover"
                        src="{{ asset('img/home/content/car-gaa7ebd4e1_640.jpg') }}" alt="">
                </figure>
                <header class="mt-2">

                    <h1 class="text-center text-xl text-gray-400">
                        Lorem, ipsum.
                    </h1>
                    <p class="text-sm text-gray-300">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Dignissimos, aspernatur?</p>
                </header>
            </article>
            <article>
                <figure>
                    <img class="rounded-xl h-36 w-full object-cover"
                        src="{{ asset('img/home/content/audi-a3-gb143c57e8_640.jpg') }}" alt="">
                </figure>
                <header class="mt-2">

                    <h1 class="text-center text-xl text-gray-400">
                        Lorem, ipsum.
                    </h1>
                    <p class="text-sm text-gray-300">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Dignissimos, aspernatur?</p>
                </header>
            </article>
            <article>
                <figure>
                    <img class="rounded-xl h-36 w-full object-cover"
                        src="{{ asset('img/home/content/automobile-gf9c29d6a1_640.jpg') }}" alt="">
                </figure>
                <header class="mt-2">

                    <h1 class="text-center text-xl text-gray-400">
                        Lorem, ipsum.
                    </h1>
                    <p class="text-sm text-gray-300">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Dignissimos, aspernatur?</p>
                </header>
            </article>
            <article>
                <figure>
                    <img class="rounded-xl h-36 w-full object-cover"
                        src="{{ asset('img/home/content/chevy-impala-ga2c01d4f5_640.jpg') }}" alt="">
                </figure>
                <header class="mt-2">

                    <h1 class="text-center text-xl text-gray-400">
                        Lorem, ipsum.
                    </h1>
                    <p class="text-sm text-gray-300">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Dignissimos, aspernatur?</p>
                </header>
            </article>
        </div>
    </section>
</x-app-layout>

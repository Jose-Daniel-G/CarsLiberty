<x-app-layout>
    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Carrusel con altura ajustada -->
                <div id="carouselExampleIndicators" class="relative w-full" data-carousel="slide">
                    <div class="relative w-full overflow-hidden rounded-lg">
                        <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                            <img src="{{asset('favicons/images/1.jpg')}}" class="block w-full h-96 object-cover" alt="First Slide">
                        </div>
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{asset('favicons/images/2.jpg')}}" class="block w-full h-96 object-cover" alt="Second Slide">
                        </div>
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{asset('favicons/images/3.jpg')}}" class="block w-full h-96 object-cover" alt="Third Slide">
                        </div>
                    </div>
                    <!-- Controles -->
                    <button type="button" class="absolute top-1/2 left-0 z-30 flex items-center justify-center w-10 h-10 -translate-y-1/2 bg-gray-800 text-white cursor-pointer rounded-full" data-carousel-prev>
                        <span class="sr-only">Previous</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button type="button" class="absolute top-1/2 right-0 z-30 flex items-center justify-center w-10 h-10 -translate-y-1/2 bg-gray-800 text-white cursor-pointer rounded-full" data-carousel-next>
                        <span class="sr-only">Next</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

 <!-- Tailwind CSS and Custom JS -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const items = document.querySelectorAll('[data-carousel-item]');
            let currentIndex = 0;

            function showSlide(index) {
                items.forEach((item, i) => {
                    item.classList.toggle('hidden', i !== index);
                });
            }

            document.querySelector('[data-carousel-prev]').addEventListener('click', () => {
                currentIndex = (currentIndex > 0) ? currentIndex - 1 : items.length - 1;
                showSlide(currentIndex);
            });

            document.querySelector('[data-carousel-next]').addEventListener('click', () => {
                currentIndex = (currentIndex < items.length - 1) ? currentIndex + 1 : 0;
                showSlide(currentIndex);
            });

            showSlide(currentIndex); // Show the first slide initially
        });
    </script>
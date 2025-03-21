<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nueva Categoría') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Profile Card -->
                <div class="bg-white shadow rounded-lg p-6">
                    {{-- <img class="rounded-t-lg" src="{{ asset('/img/socialbg.jpg') }}" alt="Card image"> --}}
                    <div class="text-center py-4">
                        <img class="mx-auto rounded-full h-24 w-24" src="{{ asset('img/1.jpg') }}" alt="users">
                        <h4 class="mt-4 text-lg font-semibold">James Anderson</h4>
                        <p class="text-gray-600">@jamesandre</p>
                        <p class="text-gray-600 text-sm">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt
                        </p>
                    </div>
                    <div class="p-4 border-t">
                        <p><span class="text-gray-600">Email:</span> hannagover@gmail.com</p>
                        <p><span class="text-gray-600">Phone:</span> +91 654 784 547</p>
                        <p><span class="text-gray-600">Address:</span> 71 Pilgrim Avenue Chevy Chase, MD 20815</p>
                    </div>
                    <div class="p-4 flex justify-center space-x-4">
                        <a href="#" class="text-blue-500"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-blue-400"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-red-500"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <!-- Tabs Section -->
                <div class="col-span-2 bg-white shadow rounded-lg">
                    <div class="border-b">
                        <nav class="flex space-x-4 p-4">
                            <button class="text-blue-500 border-b-2 border-blue-500 focus:outline-none" onclick="openTab(event, 'profile')">Profile</button>
                            <button class="text-gray-500 hover:text-blue-500 focus:outline-none" onclick="openTab(event, 'settings')">Settings</button>
                        </nav>
                    </div>

                    <div class="p-6">
                        <!-- Profile Tab -->
                        <div id="profile" class="tab-content">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <strong>Full Name</strong>
                                    <p class="text-gray-600">Johnathan Deo</p>
                                </div>
                                <div>
                                    <strong>Mobile</strong>
                                    <p class="text-gray-600">(123) 456 7890</p>
                                </div>
                                <div>
                                    <strong>Email</strong>
                                    <p class="text-gray-600">johnathan@admin.com</p>
                                </div>
                                <div>
                                    <strong>Location</strong>
                                    <p class="text-gray-600">London</p>
                                </div>
                            </div>
                            <p class="text-gray-600">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Nullam dictum felis eu pede mollis pretium.
                            </p>
                            <h4 class="font-medium mt-6">Skill Set</h4>
                            <div class="mt-4">
                                <div class="flex justify-between text-sm">
                                    <span>Wordpress</span>
                                    <span>80%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 80%"></div>
                                </div>
                            </div>
                            <!-- Repeat similar sections for other skills -->
                        </div>

                        <!-- Settings Tab -->
                        <div id="settings" class="tab-content hidden">
                            <form class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium">Full Name</label>
                                    <input type="text" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Johnathan Doe">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium">Email</label>
                                    <input type="email" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="johnathan@admin.com">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium">Password</label>
                                    <input type="password" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium">Phone No</label>
                                    <input type="text" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="123 456 7890">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium">Message</label>
                                    <textarea rows="3" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium">Country</label>
                                    <select class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                        <option>London</option>
                                        <option>India</option>
                                        <option>USA</option>
                                        <option>Canada</option>
                                    </select>
                                </div>
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function openTab(event, tabName) {
        let i, tabContent, tabLinks;
        tabContent = document.getElementsByClassName("tab-content");
        for (i = 0; i < tabContent.length; i++) {
            tabContent[i].classList.add("hidden");
        }
        tabLinks = event.currentTarget.parentNode.children;
        for (i = 0; i < tabLinks.length; i++) {
            tabLinks[i].classList.remove("text-blue-500", "border-blue-500");
            tabLinks[i].classList.add("text-gray-500");
        }
        document.getElementById(tabName).classList.remove("hidden");
        event.currentTarget.classList.add("text-blue-500", "border-blue-500");
    }
</script>

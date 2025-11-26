<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Financial Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ==== STAT CARDS ==== --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                {{-- Today’s Invoices --}}
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-xl transform hover:scale-[1.02] transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Today's Invoices</p>
                            <p class="text-3xl font-bold mt-1">₹48,500</p>
                            <p class="text-blue-200 text-xs mt-2">12 Invoices</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-file-invoice-dollar text-xl"></i>
                        </div>
                    </div>
                </div>

                {{-- Today’s Orders --}}
                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-6 text-white shadow-xl transform hover:scale-[1.02] transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-emerald-100 text-sm font-medium">Today's Orders</p>
                            <p class="text-3xl font-bold mt-1">₹1,24,800</p>
                            <p class="text-emerald-200 text-xs mt-2">28 Orders</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-xl"></i>
                        </div>
                    </div>
                </div>

                {{-- Last Month Invoices --}}
                <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl p-6 text-white shadow-xl transform hover:scale-[1.02] transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-indigo-100 text-sm font-medium">Last Month Invoices</p>
                            <p class="text-3xl font-bold mt-1">₹18,42,300</p>
                            <p class="text-indigo-200 text-xs mt-2">342 Invoices</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-receipt text-xl"></i>
                        </div>
                    </div>
                </div>

                {{-- Last Month Orders --}}
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-xl transform hover:scale-[1.02] transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Last Month Orders</p>
                            <p class="text-3xl font-bold mt-1">₹32,18,900</p>
                            <p class="text-purple-200 text-xs mt-2">589 Orders</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-truck text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ==== MODERN KPI SUMMARY (Replaces Chart) ==== --}}
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl p-8 border border-white/20">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-bold text-gray-800">2025 Performance Summary</h3>
                    <div class="flex items-center space-x-2 text-sm font-medium text-emerald-600">
                        <i class="fas fa-arrow-up"></i>
                        <span>+28% vs last year</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Revenue Growth -->
                    <div class="text-center">
                        <div class="relative inline-flex items-center justify-center">
                            <svg class="w-32 h-32 transform -rotate-90">
                                <circle cx="64" cy="64" r="56" stroke="#e5e7eb" stroke-width="12" fill="none"/>
                                <circle cx="64" cy="64" r="56" stroke="#10b981" stroke-width="12" fill="none"
                                        stroke-dasharray="352" stroke-dashoffset="88"
                                        class="transition-all duration-1000 ease-out"/>
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span class="text-3xl font-bold text-gray-800">75%</span>
                                <span class="text-xs text-gray-500 mt-1">Revenue Growth</span>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-gray-600">Target: ₹64L → Achieved: ₹48.2L</p>
                    </div>

                    <!-- Order Fulfillment -->
                    <div class="text-center">
                        <div class="relative inline-flex items-center justify-center">
                            <svg class="w-32 h-32 transform -rotate-90">
                                <circle cx="64" cy="64" r="56" stroke="#e5e7eb" stroke-width="12" fill="none"/>
                                <circle cx="64" cy="64" r="56" stroke="#3b82f6" stroke-width="12" fill="none"
                                        stroke-dasharray="352" stroke-dashoffset="70.4"
                                        class="transition-all duration-1000 ease-out"/>
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span class="text-3xl font-bold text-gray-800">80%</span>
                                <span class="text-xs text-gray-500 mt-1">Order Fulfillment</span>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-gray-600">589 / 736 Orders Delivered</p>
                    </div>

                    <!-- Customer Satisfaction -->
                    <div class="text-center">
                        <div class="relative inline-flex items-center justify-center">
                            <svg class="w-32 h-32 transform -rotate-90">
                                <circle cx="64" cy="64" r="56" stroke="#e5e7eb" stroke-width="12" fill="none"/>
                                <circle cx="64" cy="64" r="56" stroke="#8b5cf6" stroke-width="12" fill="none"
                                        stroke-dasharray="352" stroke-dashoffset="35.2"
                                        class="transition-all duration-1000 ease-out"/>
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span class="text-3xl font-bold text-gray-800">90%</span>
                                <span class="text-xs text-gray-500 mt-1">Satisfaction Rate</span>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-gray-600">4.8/5 from 1,248 reviews</p>
                    </div>
                </div>

                <!-- Footer Insight -->
                <div class="mt-10 text-center">
                    <p class="text-sm text-gray-500">
                        <i class="fas fa-lightbulb text-yellow-500 mr-1"></i>
                        <strong>Insight:</strong> Q4 projections show <span class="text-emerald-600 font-semibold">₹62L</span> potential with current trend.
                    </p>
                </div>
            </div>

        </div>
    </div>

    {{-- No scripts needed! Pure CSS + SVG animation --}}
</x-app-layout>
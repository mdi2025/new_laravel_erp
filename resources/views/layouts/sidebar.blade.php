<nav x-data="{
        open: localStorage.getItem('sidebarOpen') === 'true',
        mobileOpen: false,
        customerOpen: false,
        vendorOpen: false,
        inventoryOpen: false,
        productionOpen: false,
        shippingOpen: false,
        reportsOpen: false,
        bankingOpen: false,
        ledgerOpen: false,
        companyOpen: false,
        auditOpen: false,
        customerOpen: false,
        customerSubmenu: false,
        ordersSubmenu: false,
    }"
    x-init="
        $watch('open', v => localStorage.setItem('sidebarOpen', v));
        $el.classList.toggle('w-72', open);
        $el.classList.toggle('w-20', !open);
    "
    x-cloak
    class="fixed inset-y-0 left-0 z-50 flex flex-col bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white transition-all duration-300 ease-out backdrop-blur-xl border-r border-white/10 lg:relative lg:translate-x-0"
    :class="open ? 'w-72' : 'w-20', mobileOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">

    <!-- Sidebar Header -->
    <div class="flex items-center justify-between p-5 border-b border-white/10">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
            <div class="w-10 h-10 bg-gradient-to-tr from-cyan-500 via-blue-600 to-indigo-700 rounded-2xl flex items-center justify-center shadow-xl ring-2 ring-white/20 group-hover:scale-105 transition-transform duration-200">
                <i class="fas fa-rocket text-white text-base"></i>
            </div>
            <span x-show="open" x-transition:enter="transition-opacity duration-200" x-transition:leave="transition-opacity duration-100"
                  class="text-2xl font-black tracking-tighter bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 to-blue-300">
                MDI
            </span>
        </a>
        <!-- Collapse Button (Desktop) -->
        <button @click="open = !open" class="hidden lg:flex items-center justify-center w-9 h-9 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-md transition-all duration-200 group">
            <i :class="open ? 'fa-chevron-left' : 'fa-chevron-right'" class="fas text-sm text-white/70 group-hover:text-white transition"></i>
        </button>
        <!-- Close Button (Mobile) -->
        <button @click="mobileOpen = !mobileOpen" class="lg:hidden flex items-center justify-center w-9 h-9 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-md transition">
            <i class="fas fa-times text-white/70"></i>
        </button>
    </div>

    <!-- Navigation Links -->
    <div class="flex-1 overflow-y-auto py-6 px-3 space-y-1.5 scrollbar-thin scrollbar-thumb-white/20 scrollbar-track-transparent">
        
        <!-- Dashboard (Clickable) -->
        <a href="{{ route('dashboard') }}"
           class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl text-sm font-medium transition-all duration-300 group relative overflow-hidden"
           :class="request()->routeIs('dashboard')
               ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-2xl ring-2 ring-cyan-400/30 scale-105'
               : 'text-gray-300 hover:bg-white/10 hover:text-white hover:shadow-lg hover:scale-[1.02]'">
            <div x-show="request()->routeIs('dashboard')" class="absolute inset-y-0 left-0 w-1 bg-cyan-400"></div>
            <i class="fas fa-tachometer-alt w-5 h-5" :class="request()->routeIs('dashboard') ? 'text-white' : 'text-cyan-400 group-hover:text-white'"></i>
            <span x-show="open" x-transition class="font-medium">Dashboard</span>
            <span x-show="!open" class="absolute left-full ml-3 px-3 py-1.5 bg-gray-800 text-white text-xs font-medium rounded-lg whitespace-nowrap opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-200 z-50 shadow-xl">
                Dashboard
                <div class="absolute top-1/2 left-0 -translate-y-1/2 -translate-x-1.5 w-0 h-0 border-4 border-transparent border-r-gray-800"></div>
            </span>
        </a>

  <!-- Customer + Submenu -->
<div>
    <button @click="customerOpen = !customerOpen" 
            class="w-full flex items-center justify-between px-4 py-3.5 rounded-2xl text-sm font-medium text-gray-300 hover:bg-white/10 hover:text-white hover:shadow-lg hover:scale-[1.02] transition-all duration-300 group relative">
        <div class="flex items-center space-x-3">
            <i class="fas fa-users w-5 h-5 text-emerald-400 group-hover:text-white"></i>
            <span x-show="open" x-transition class="font-medium">Customer</span>
        </div>
        <i :class="customerOpen ? 'fa-chevron-down' : 'fa-chevron-right'" 
           class="fas text-xs text-gray-400 transition-transform duration-200" x-show="open"></i>
    </button>

    <!-- Submenu -->
    <div x-show="open && customerOpen" x-collapse x-transition class="ml-8 mt-1 space-y-1">

        <!-- Customer Group -->
        <div>
            <button @click="customerSubmenu = !customerSubmenu"
                    class="flex items-center justify-between w-full px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-user w-4 h-4"></i>
                    <span>Customer</span>
                </div>
                <i :class="customerSubmenu ? 'fa-chevron-down' : 'fa-chevron-right'"
                   class="fas text-[10px] text-gray-400"></i>
            </button>

            <!-- Customer Submenu Items -->
            <div x-show="customerSubmenu" x-collapse class="ml-6 mt-1 space-y-1">
                <a href="{{ route('customer.customers.new', ['type' => 'c']) }}" @click="closeMobile()"
                   class="flex items-center space-x-3 px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fas fa-user-plus w-4 h-4"></i>
                    <span>New Customer</span>
                </a>

                <a href="{{ route('customers.index') }}" @click="closeMobile()"
                   class="flex items-center space-x-3 px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fas fa-list w-4 h-4"></i>
                    <span>Customer Manager</span>
                </a>
            </div>
        </div>

        <!-- Orders Group -->
        <div>
            <button @click="ordersSubmenu = !ordersSubmenu"
                    class="flex items-center justify-between w-full px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition ">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-shopping-cart w-4 h-4"></i>
                    <span>Orders</span>
                </div>
                <i :class="ordersSubmenu ? 'fa-chevron-down' : 'fa-chevron-right'"
                   class="fas text-[10px] text-gray-400"></i>
            </button>

            <!-- Orders Submenu Items -->
            <div x-show="ordersSubmenu" x-collapse class="ml-6 mt-1 space-y-1">
                    <a href="{{ route('sale_orders') }}" @click="closeMobile()"
                    class="flex items-center space-x-3 px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                        <i class="fas fa-file-invoice w-4 h-4"></i>
                        <span>New Sale Orders</span>
                    </a>

                    <a href="{{ route('sale_orders_manager') }}" @click="closeMobile()"
                    class="flex items-center space-x-3 px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                        <i class="fas fa-folder-open w-4 h-4"></i>
                        <span>Sale Order Manager</span>
                    </a>
            </div>
        </div>

    </div>
</div>

        <!-- Vendor + Submenu -->
        <div>
            <button @click="vendorOpen = !vendorOpen" 
                    class="w-full flex items-center justify-between px-4 py-3.5 rounded-2xl text-sm font-medium text-gray-300 hover:bg-white/10 hover:text-white hover:shadow-lg hover:scale-[1.02] transition-all duration-300 group relative">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-truck w-5 h-5 text-amber-400 group-hover:text-white"></i>
                    <span x-show="open" x-transition class="font-medium">Vendor</span>
                </div>
                <i :class="vendorOpen ? 'fa-chevron-down' : 'fa-chevron-right'" class="fas text-xs text-gray-400 transition-transform duration-200" x-show="open"></i>
            </button>

            <div x-show="open && vendorOpen" x-collapse x-transition class="ml-8 mt-1 space-y-1">
                <div class="flex items-center space-x-3 px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fas fa-plus w-4 h-4"></i>
                    <span>Add Vendor</span>
                </div>
                <div class="flex items-center space-x-3 px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fas fa-th-list w-4 h-4"></i>
                    <span>Vendor List</span>
                </div>
            </div>
        </div>

        <!-- Inventory + Submenu -->
        <div>
            <button @click="inventoryOpen = !inventoryOpen" 
                    class="w-full flex items-center justify-between px-4 py-3.5 rounded-2xl text-sm font-medium text-gray-300 hover:bg-white/10 hover:text-white hover:shadow-lg hover:scale-[1.02] transition-all duration-300 group relative">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-boxes w-5 h-5 text-purple-400 group-hover:text-white"></i>
                    <span x-show="open" x-transition class="font-medium">Inventory</span>
                </div>
                <i :class="inventoryOpen ? 'fa-chevron-down' : 'fa-chevron-right'" class="fas text-xs text-gray-400 transition-transform duration-200" x-show="open"></i>
            </button>

            <div x-show="open && inventoryOpen" x-collapse x-transition class="ml-8 mt-1 space-y-1">
                <div class="flex items-center space-x-3 px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fas fa-warehouse w-4 h-4"></i>
                    <span>Stock Levels</span>
                </div>
                <div class="flex items-center space-x-3 px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fas fa-exchange-alt w-4 h-4"></i>
                    <span>Adjustments</span>
                </div>
            </div>
        </div>

        <!-- Production + Submenu -->
        <div>
            <button @click="productionOpen = !productionOpen" 
                    class="w-full flex items-center justify-between px-4 py-3.5 rounded-2xl text-sm font-medium text-gray-300 hover:bg-white/10 hover:text-white hover:shadow-lg hover:scale-[1.02] transition-all duration-300 group relative">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-cogs w-5 h-5 text-orange-400 group-hover:text-white"></i>
                    <span x-show="open" x-transition class="font-medium">Production</span>
                </div>
                <i :class="productionOpen ? 'fa-chevron-down' : 'fa-chevron-right'" class="fas text-xs text-gray-400 transition-transform duration-200" x-show="open"></i>
            </button>

            <div x-show="open && productionOpen" x-collapse x-transition class="ml-8 mt-1 space-y-1">
                <div class="flex items-center space-x-3 px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fas fa-tools w-4 h-4"></i>
                    <span>Work Orders</span>
                </div>
                <div class="flex items-center space-x-3 px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fas fa-industry w-4 h-4"></i>
                    <span>Lines</span>
                </div>
            </div>
        </div>

        <!-- Shipping + Submenu -->
        <div>
            <button @click="shippingOpen = !shippingOpen" 
                    class="w-full flex items-center justify-between px-4 py-3.5 rounded-2xl text-sm font-medium text-gray-300 hover:bg-white/10 hover:text-white hover:shadow-lg hover:scale-[1.02] transition-all duration-300 group relative">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-shipping-fast w-5 h-5 text-blue-400 group-hover:text-white"></i>
                    <span x-show="open" x-transition class="font-medium">Shipping</span>
                </div>
                <i :class="shippingOpen ? 'fa-chevron-down' : 'fa-chevron-right'" class="fas text-xs text-gray-400 transition-transform duration-200" x-show="open"></i>
            </button>

            <div x-show="open && shippingOpen" x-collapse x-transition class="ml-8 mt-1 space-y-1">
                <div class="flex items-center space-x-3 px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fas fa-truck-loading w-4 h-4"></i>
                    <span>Shipments</span>
                </div>
                <div class="flex items-center space-x-3 px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fas fa-route w-4 h-4"></i>
                    <span>Tracking</span>
                </div>
            </div>
        </div>

        <!-- Reports + Submenu -->
        <div>
            <button @click="reportsOpen = !reportsOpen"
                class="w-full flex items-center justify-between px-4 py-3.5 rounded-2xl text-sm font-medium text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-300 group">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-file-alt w-5 h-5 text-yellow-400 group-hover:text-white"></i>
                    <span x-show="open" x-transition>Reports</span>
                </div>
                <i :class="reportsOpen ? 'fa-chevron-down' : 'fa-chevron-right'" 
                x-show="open"
                class="fas text-xs text-gray-400 transition-transform duration-200"></i>
            </button>

            <!-- Reports submenu -->
            <div x-show="open && reportsOpen" x-collapse class="ml-8 mt-1 space-y-1">

                <a href="" @click="closeMobile()"
                    class="flex items-center space-x-3 px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fas fa-book w-4 h-4"></i>
                    <span>General Ledger</span>
                </a>

                <!-- Audit Log -->
                <button @click.stop="auditOpen = !auditOpen"
                    class="w-full flex items-center justify-between px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-search w-4 h-4"></i>
                        <span>Audit Log</span>
                    </div>
                    <i :class="auditOpen ? 'fa-chevron-down' : 'fa-chevron-right'" class="fas text-xs"></i>
                </button>

                <!-- Audit submenu -->
                <div x-show="auditOpen" x-collapse class="ml-6 space-y-1">
                    <a href="{{ route('reports.customer-balances-yearly') }}" class="flex items-center space-x-3 px-4 py-2 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition">
                        <i class="fas fa-user w-4 h-4"></i>
                        <span>Customer Balances Yearly</span>
                    </a>

                    <a href="" class="flex items-center space-x-3 px-4 py-2 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition">
                        <i class="fas fa-store w-4 h-4"></i>
                        <span>Vendor Balances Yearly</span>
                    </a>
                </div>

            </div>
        </div>

        <!-- Banking + Submenu -->
        <div>
            <button @click="bankingOpen = !bankingOpen" 
                    class="w-full flex items-center justify-between px-4 py-3.5 rounded-2xl text-sm font-medium text-gray-300 hover:bg-white/10 hover:text-white hover:shadow-lg hover:scale-[1.02] transition-all duration-300 group relative">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-university w-5 h-5 text-indigo-400 group-hover:text-white"></i>
                    <span x-show="open" x-transition class="font-medium">Banking</span>
                </div>
                <i :class="bankingOpen ? 'fa-chevron-down' : 'fa-chevron-right'" class="fas text-xs text-gray-400 transition-transform duration-200" x-show="open"></i>
            </button>

            <div x-show="open && bankingOpen" x-collapse x-transition class="ml-8 mt-1 space-y-1">
                <div class="flex items-center space-x-3 px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fas fa-piggy-bank w-4 h-4"></i>
                    <span>Accounts</span>
                </div>
                <div class="flex items-center space-x-3 px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class  class="fas fa-exchange-alt w-4 h-4"></i>
                    <span>Transactions</span>
                </div>
            </div>
        </div>

        <!-- General Ledger + Submenu -->
        <div>
            <button @click="ledgerOpen = !ledgerOpen" 
                    class="w-full flex items-center justify-between px-4 py-3.5 rounded-2xl text-sm font-medium text-gray-300 hover:bg-white/10 hover:text-white hover:shadow-lg hover:scale-[1.02] transition-all duration-300 group relative">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-book w-5 h-5 text-teal-400 group-hover:text-white"></i>
                    <span x-show="open" x-transition class="font-medium">General Ledger</span>
                </div>
                <i :class="ledgerOpen ? 'fa-chevron-down' : 'fa-chevron-right'" class="fas text-xs text-gray-400 transition-transform duration-200" x-show="open"></i>
            </button>

            <div x-show="open && ledgerOpen" x-collapse x-transition class="ml-8 mt-1 space-y-1">
                <div class="flex items-center space-x-3 px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fas fa-file-alt w-4 h-4"></i>
                    <span>Journal Entries</span>
                </div>
                <div class="flex items-center space-x-3 px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fas fa-balance-scale w-4 h-4"></i>
                    <span>Trial Balance</span>
                </div>
            </div>
        </div>

        <!-- Company + Submenu -->
        <div>
            <button @click="companyOpen = !companyOpen" 
                    class="w-full flex items-center justify-between px-4 py-3.5 rounded-2xl text-sm font-medium text-gray-300 hover:bg-white/10 hover:text-white hover:shadow-lg hover:scale-[1.02] transition-all duration-300 group relative">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-building w-5 h-5 text-cyan-400 group-hover:text-white"></i>
                    <span x-show="open" x-transition class="font-medium">Company</span>
                </div>
                <i :class="companyOpen ? 'fa-chevron-down' : 'fa-chevron-right'" class="fas text-xs text-gray-400 transition-transform duration-200" x-show="open"></i>
            </button>

            <div x-show="open && companyOpen" x-collapse x-transition class="ml-8 mt-1 space-y-1">
                <div class="flex items-center space-x-3 px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fas fa-cog w-4 h-4"></i>
                    <span>Settings</span>
                </div>
                <div class="flex items-center space-x-3 px-4 py-2.5 text-xs text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition">
                    <i class="fas fa-shield-alt w-4 h-4"></i>
                    <span>Security</span>
                </div>
            </div>
        </div>

    </div>

    <!-- Bottom Actions -->
    <div class="p-4 border-t border-white/10 space-y-2">
        <x-responsive-nav-link :href="route('profile.edit')"
            class="flex items-center space-x-3 px-4 py-3.5 rounded-2xl text-sm font-medium text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-200 group">
            <i class="fas fa-user-circle w-5 h-5 text-purple-400 group-hover:text-white"></i>
            <span x-show="open">Profile</span>
        </x-responsive-nav-link>

        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit"
                class="w-full flex items-center space-x-3 px-4 py-3.5 rounded-2xl text-sm font-medium text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-all duration-200 group backdrop-blur-md">
                <i class="fas fa-sign-out-alt w-5 h-5"></i>
                <span x-show="open">Log Out</span>
            </button>
        </form>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
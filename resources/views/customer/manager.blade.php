<x-app-layout>
    <x-slot name="title">Customers</x-slot>
    <!-- Reduced outer padding -->
    <div class="pt-4 px-2 sm:px-4 lg:px-6">
        <div class="max-w-7xl mx-auto">

            <!-- ONE CARD – no top margin -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden mt-0">

                <!-- 1. Header (blue-white gradient) -->
                <div class="bg-gradient-to-r from-blue-700 via-blue-600 to-blue-500 p-6 text-white">
                    <h1 class="text-4xl font-extrabold tracking-tight drop-shadow-md">
                        Customers Manager
                    </h1>
                    <p class="mt-1 text-sm opacity-90">
                        Browse and search all customer records.
                    </p>
                </div>

                <!-- 2. Search (sticks to header) -->
                <div class="px-6 pt-4 pb-2">
                    <div class="relative w-full max-w-2xl">
                        <input type="text" id="search"
                               placeholder="Search by name, email, or company..."
                               class="w-full pl-12 pr-4 py-3 text-base border border-gray-300 
                                      rounded-xl focus:ring-2 focus:ring-indigo-500 
                                      focus:border-indigo-500 transition-shadow shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- 3. Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="table-body" class="bg-white divide-y divide-gray-200">
                            <!-- JS injects rows here -->
                        </tbody>
                    </table>
                </div>

                <!-- 4. Pagination -->
                <div class="bg-gray-50 px-6 py-3 border-t border-gray-200 flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Showing <span id="showing-from">0</span> to <span id="showing-to">0</span> of <span id="total-rows">0</span> results
                    </div>
                    <div class="flex items-center space-x-2">
                        <button id="prev-btn" disabled
                                class="px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed transition">
                            Previous
                        </button>

                        <div class="flex items-center space-x-1">
                            <span class="text-sm text-gray-600">Page</span>
                            <span id="current-page" class="px-3 py-1 text-sm font-semibold text-indigo-600 bg-indigo-50 rounded-md min-w-[2.5rem] text-center">1</span>
                            <span class="text-sm text-gray-500">of</span>
                            <span id="total-pages" class="text-sm font-medium text-gray-700">1</span>
                        </div>

                        <button id="next-btn" disabled
                                class="px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed transition">
                            Next
                        </button>
                    </div>
                </div>
            </div>

            <!-- Summary (optional, outside card) -->
            <div class="mt-4 text-sm text-gray-600">
                Showing <span id="summary-from">0</span>–<span id="summary-to">0</span> of <span id="summary-total">0</span> customers
            </div>

        </div>
    </div>

    <!-- JavaScript -->
    <script>
        const PAGE_SIZE = 10;
        let currentPage = 1;
        let allCustomers = [];           // raw JSON
        let filteredRows = [];           // <tr> elements
        const tbody = document.getElementById('table-body');

        // UI elements
        const fromEl   = document.getElementById('showing-from');
        const toEl     = document.getElementById('showing-to');
        const totalEl  = document.getElementById('total-rows');
        const prevBtn  = document.getElementById('prev-btn');
        const nextBtn  = document.getElementById('next-btn');
        const curPage  = document.getElementById('current-page');
        const totPages = document.getElementById('total-pages');
        const sumFrom  = document.getElementById('summary-from');
        const sumTo    = document.getElementById('summary-to');
        const sumTotal = document.getElementById('summary-total');

        // Build a table row from a customer object
        function buildRow(c) {
            const fullName = [c.first_name, c.middle_name, c.last_name].filter(Boolean).join(' ');
            const initials = (c.first_name?.[0] ?? '') + (c.last_name?.[0] ?? '');
            const avatarClass = `bg-gradient-to-r from-indigo-500 to-purple-500`;

            const statusClass = c.inactive
                ? 'bg-red-100 text-red-800'
                : 'bg-green-100 text-green-800';

            const tr = document.createElement('tr');
            tr.className = 'hover:bg-gray-50 transition';
            tr.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full ${avatarClass} flex items-center justify-center text-white font-semibold text-sm">
                            ${initials || '??'}
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900">${fullName || '—'}</span>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${c.email || '—'}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${c.company_name || '—'}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full ${statusClass}">
                        ${c.inactive ? 'Inactive' : 'Active'}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                    <a href="/customer/${c.customer_id}" class="text-indigo-600 hover:text-indigo-900">View</a>
                    <a href="/customer/${c.customer_id}/edit" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                    <button onclick="deleteCustomer('${c.customer_id}')" class="text-red-600 hover:text-red-900">Delete</button>
                </td>
            `;
            return tr;
        }

        // Render current page
        function renderPage() {
            const start = (currentPage - 1) * PAGE_SIZE;
            const end   = Math.min(start + PAGE_SIZE, filteredRows.length);

            tbody.innerHTML = '';
            filteredRows.slice(start, end).forEach(row => tbody.appendChild(row));

            const from = filteredRows.length ? start + 1 : 0;
            const to   = end;

            fromEl.textContent = from;   toEl.textContent = to;   totalEl.textContent = filteredRows.length;
            sumFrom.textContent = from;  sumTo.textContent = to;   sumTotal.textContent = filteredRows.length;

            curPage.textContent = currentPage;
            const pages = Math.ceil(filteredRows.length / PAGE_SIZE) || 1;
            totPages.textContent = pages;

            prevBtn.disabled = currentPage === 1;
            nextBtn.disabled = end >= filteredRows.length;
        }

        // Pagination
        prevBtn.onclick = () => { if (currentPage > 1) { currentPage--; renderPage(); } };
        nextBtn.onclick = () => { if (currentPage * PAGE_SIZE < filteredRows.length) { currentPage++; renderPage(); } };

        // Search
        document.getElementById('search').addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();
            filteredRows = allCustomers
                .filter(c => {
                    const hay = `${c.first_name} ${c.middle_name} ${c.last_name} ${c.company_name} ${c.email}`.toLowerCase();
                    return hay.includes(q);
                })
                .map(buildRow);
            currentPage = 1;
            renderPage();
        });

        // Load data
        async function loadCustomers() {
            try {
                const res = await fetch('{{ route('customers.index') }}', {
                    headers: { 'Accept': 'application/json' }
                });
                allCustomers = await res.json();

                filteredRows = allCustomers.map(buildRow);
                renderPage();
            } catch (err) {
                console.error(err);
                tbody.innerHTML = `<tr><td colspan="5" class="px-6 py-4 text-center text-red-600">Failed to load customers.</td></tr>`;
            }
        }
        window.deleteCustomer = function (id) {
            if (confirm('Delete this customer?')) {
                alert('DELETE endpoint not implemented yet.');
            }
        };
        loadCustomers();
    </script>
</x-app-layout> 
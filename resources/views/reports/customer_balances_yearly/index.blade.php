<x-app-layout>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">

    <!-- Modern Header Card - Blue & White Only -->
    <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 text-white p-8 relative overflow-hidden">
        <!-- Subtle white overlay for depth -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
        
        <!-- Floating white accent orb (modern touch) -->
        <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl -mr-36 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -ml-32 -mb-32"></div>

        <div class="relative z-10">
            <h2 class="font-black text-3xl tracking-wider uppercase flex items-center gap-3">
           
                Customer Balances Yearly Report
            </h2>
            <p class="text-blue-100 mt-2 text-lg font-medium opacity-95">
                Detailed invoicing, payments & closing balances
            </p>
        </div>
    </div>

                <div class="p-6 space-y-6" x-data="report()">
                    <h4> Select Fiscal year</h4>
                    <!-- Controls: FY + Export -->
                    <div class="flex flex-col sm:flex-row gap-4 items-end justify-between bg-gradient-to-br from-gray-50 to-gray-100 p-5 rounded-xl border border-gray-200 shadow-sm">
                        <div class="flex-1 min-w-64">

                            <select x-model="year" @change="load()"
                                    class="w-full px-4 py-3 text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 shadow-sm">
                                <option value="" disabled selected>Select Fiscal year</option>
                                @forelse($fiscalYears as $fy)
                                    <option value="{{ $fy }}">{{ $fy }}</option>
                                @empty
                                    <option value="2024-2025">2024-2025</option>
                                @endforelse
                            </select>
                        </div>

                        <button @click="exportExcel()" :disabled="!rows.length"
                                class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 disabled:bg-gray-400 disabled:cursor-not-allowed text-white font-medium rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Export Excel
                        </button>
                    </div>

                    <!-- MODERN LOADING CARD -->
                    <div x-show="loading" x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 backdrop-blur-md">
                        <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-sm w-full mx-4 transform transition-all">
                            <div class="flex flex-col items-center space-y-5">
                                <div class="relative">
                                    <div class="animate-spin rounded-full h-16 w-16 border-4 border-indigo-200"></div>
                                    <div class="animate-spin rounded-full h-16 w-16 border-4 border-indigo-600 border-t-transparent absolute top-0 left-0" style="animation-direction: reverse; animation-duration: 1.5s;"></div>
                                </div>
                                <div class="text-center">
                                    <p class="text-lg font-semibold text-gray-800">Loading Report Data</p>
                                    <p class="text-sm text-gray-500 mt-1" x-text="loadingText"></p>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full animate-pulse" style="width: 70%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div x-show="!year && !loading" class="text-center py-20 text-gray-500">
                        <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-lg font-medium">Please select a fiscal year to view the report</p>
                    </div>

                    <!-- AG Grid -->
                    <div x-show="year && !loading" class="rounded-xl overflow-hidden border border-gray-200 shadow-inner">
                        <div id="grid" class="ag-theme-alpine" style="height: 680px;"></div>
                    </div>

                    <!-- Footer Note -->
                    <div x-show="year && !loading" class="text-center text-xs text-gray-500 mt-4">
                        Report generated on {{ now()->format('d M Y, h:i A') }} IST
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- AG GRID v31.3.4 -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.3.4/styles/ag-grid.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.3.4/styles/ag-theme-alpine.css">
    <script src="https://cdn.jsdelivr.net/npm/ag-grid-community@31.3.4/dist/ag-grid-community.min.js"></script>

    <!-- Excel Export -->
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

    <script>
    function report() {
        return {
            year: '',
            loading: false,
            loadingText: 'Please wait',
            rows: [],
            fy: {},

            load() {
                if (!this.year) return;

                const [y1, y2] = this.year.split('-');
                const start = `${y1}-04-01`;
                const end   = `${y2}-03-31`;
                this.loading = true;
                this.rows = [];
                this.fy = {};
                this.startLoadingAnimation();

                fetch(`{{ route('reports.customer-balances-yearly.data') }}?start_date=${start}&end_date=${end}`)
                    .then(r => r.json())
                    .then(d => {
                        this.rows = d.data ?? [];
                        this.fy   = d.financial_years ?? {};
                        this.render();
                    })
                    .catch(e => {
                        console.error('Load error:', e);
                        alert('Failed to load data. Please try again.');
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },

            startLoadingAnimation() {
                const messages = [
                    'Fetching financial data...',
                    'Calculating balances...',
                    'Almost there...'
                ];
                let i = 0;
                const interval = setInterval(() => {
                    this.loadingText = messages[i % messages.length];
                    i++;
                }, 1200);
                this.$watch('loading', (val) => {
                    if (!val) clearInterval(interval);
                });
            },

            render() {
                const sf = this.fy.start_fy?.replace(/-/g, '_');
                const ef = this.fy.end_fy?.replace(/-/g, '_');

                if (window.gridApi) {
                    window.gridApi.destroy();
                }

                const gridOptions = {
                    columnDefs: [
                        { headerName: "CUSTOMER ID", field: "bill_acct_id",   width: 90,  cellStyle: { fontWeight: '600' } },
                        { headerName: "CUSTOMER ID",        field: "short_name",     width: 110, cellStyle: { color: '#1f2937' } },
                        { headerName: "CUSTOMER NAME",    field: "contact_first",  width: 280, cellStyle: { color: '#374151' } },
                        { headerName: `Inv Till ${this.fy.start_fy}`, field: `invoiced_till_${sf}`, valueFormatter: params => params.value ? Number(params.value).toLocaleString('en-IN', { minimumFractionDigits: 2 }) : '0.00' },
                        { headerName: `Pay Till ${this.fy.start_fy}`, field: `payment_till_${sf}`, valueFormatter: params => params.value ? Number(params.value).toLocaleString('en-IN', { minimumFractionDigits: 2 }) : '0.00' },
                        { headerName: `Opening ${this.fy.end_fy}`,   field: `opening_in_${ef}`,   valueFormatter: params => params.value ? Number(params.value).toLocaleString('en-IN', { minimumFractionDigits: 2 }) : '0.00', cellStyle: { fontWeight: 'bold', color: '#7c3aed' } },
                        { headerName: `Inv ${this.fy.end_fy}`,       field: `invoiced_in_${ef}`,  valueFormatter: params => params.value ? Number(params.value).toLocaleString('en-IN', { minimumFractionDigits: 2 }) : '0.00' },
                        { headerName: `Pay ${this.fy.end_fy}`,       field: `payment_in_${ef}`,  valueFormatter: params => params.value ? Number(params.value).toLocaleString('en-IN', { minimumFractionDigits: 2 }) : '0.00' },
                        { headerName: "Closing", field: "closing", cellStyle: { fontWeight: 'bold', color: '#dc2626' }, valueFormatter: params => params.value ? Number(params.value).toLocaleString('en-IN', { minimumFractionDigits: 2 }) : '0.00' }
                    ],
                    rowData: this.rows,
                    pagination: true,
                    paginationPageSize: 25,
                    defaultColDef: {
                        sortable: true,
                        filter: true,
                        resizable: true,
                        flex: 1,
                        minWidth: 120,
                        cellStyle: { fontSize: '14px' }
                    },
                    onGridReady: (params) => {
                        window.gridApi = params.api;
                        console.log('AG GRID v31.3.4 INITIALIZED!');
                    }
                };

                new agGrid.Grid(document.getElementById('grid'), gridOptions);
            },
            exportExcel() {
                if (!this.rows.length) return;
                const sf = this.fy.start_fy?.replace(/-/g, '_');
                const ef = this.fy.end_fy?.replace(/-/g, '_');
                const ws = XLSX.utils.aoa_to_sheet([
                    ["ID","Code","Name",`Inv ${this.fy.start_fy}`,`Pay ${this.fy.start_fy}`,`Opening ${this.fy.end_fy}`,`Inv ${this.fy.end_fy}`,`Pay ${this.fy.end_fy}`,"Closing"],
                    ...this.rows.map(r => [
                        r.bill_acct_id, r.short_name, r.contact_first,
                        r[`invoiced_till_${sf}`] || 0,
                        r[`payment_till_${sf}`] || 0,
                        r[`opening_in_${ef}`] || 0,
                        r[`invoiced_in_${ef}`] || 0,
                        r[`payment_in_${ef}`] || 0,
                        r.closing || 0
                    ])
                ]);
                const wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, "Report");
                XLSX.writeFile(wb, `Customer_Balances_${this.year}.xlsx`);
            }
        };
    }
    </script>

</x-app-layout>
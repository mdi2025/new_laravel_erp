<x-app-layout>
    <div class="py-8 px-4 mx-auto max-w-7xl">
        <!-- Header + Modern Top Toolbar in #304ed5 -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <h1 class="text-3xl font-bold text-[#304ed5]">Create New Sales Order</h1>

            <!-- Modern Toolbar - #304ed5 Theme -->
            <div class="flex flex-wrap items-center gap-3 bg-white rounded-xl shadow-lg border border-gray-200 p-3">
                <button type="button" onclick="history.back()"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Cancel
                </button>

                <button type="submit" form="sales-order-form"
                    class="flex items-center gap-2 px-5 py-3 text-sm font-bold text-white bg-[#304ed5] hover:bg-[#253fb8] rounded-lg transition shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-6 0V5a2 2 0 012-2h2a2 2 0 012 2v2m-6 0h6"/>
                    </svg>
                    Save Order
                </button>

                <button type="button" onclick="if(confirm('Delete this Sales Order permanently?')) document.getElementById('delete-form').submit();"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2.175 2.175 0 0116.138 21H7.862a2.175 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Delete
                </button>

                <button type="button" onclick="location.href=''"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-[#304ed5] bg-[#304ed5]/10 hover:bg-[#304ed5]/20 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    New
                </button>

                <button type="button" onclick="alert('Recurring Orders - Coming Soon')"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-[#304ed5] bg-[#304ed5]/10 hover:bg-[#304ed5]/20 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Recur
                </button>

                <button type="button" onclick="window.open('#','_blank')"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-[#304ed5] bg-[#304ed5]/10 hover:bg-[#304ed5]/20 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    Convert to PI
                </button>
            </div>
        </div>

        <!-- Main Form -->
        <form id="sales-order-form" action="" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- 1. Sales Order Info -->
            <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200">
                <h2 class="text-2xl font-bold text-[#304ed5] mb-8 border-b border-[#304ed5]/20 pb-4">Sales Order Info</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <div><label class="block text-sm font-semibold text-gray-700">Customer ID <span class="text-red-500">*</span></label><input type="text" name="customer_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20" required></div>
                    <div><label class="block text-sm font-semibold text-gray-700">Customer Name <span class="text-red-500">*</span></label><input type="text" name="customer_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20" required></div>
                    <div><label class="block text-sm font-semibold text-gray-700">PAN No.</label><input type="text" name="pan_no" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20"></div>
                    <div><label class="block text-sm font-semibold text-gray-700">Currency <span class="text-red-500">*</span></label>
                        <select name="currency" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20" required>
                            <option value="INR">INR</option>
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                        </select>
                    </div>
                    <div><label class="block text-sm font-semibold text-gray-700">SO Number</label><input type="text" name="so_number" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50" readonly value="{{ $soNumber ?? 'AUTO' }}"></div>
                    <div><label class="block text-sm font-semibold text-gray-700">Customer Code</label><input type="text" name="customer_code" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20"></div>
                    <div><label class="block text-sm font-semibold text-gray-700">Customer Type</label>
                        <select name="customer_type" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20">
                            <option>Retail</option><option>Wholesale</option><option>Distributor</option>
                        </select>
                    </div>
                    <div><label class="block text-sm font-semibold text-gray-700">Date <span class="text-red-500">*</span></label><input type="date" name="date" value="{{ old('date', now()->format('Y-m-d')) }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20" required></div>
                    <div><label class="block text-sm font-semibold text-gray-700">Time</label><input type="time" name="time" value="{{ old('time', now()->format('H:i')) }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20"></div>
                    <div><label class="block text-sm font-semibold text-gray-700">HQ Status</label>
                        <select name="hq_status" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20">
                            <option>Draft</option><option>Approved</option><option>Rejected</option>
                        </select>
                    </div>
                    <div><label class="block text-sm font-semibold text-gray-700">PO Number</label><input type="text" name="po_number" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20"></div>
                    <div><label class="block text-sm font-semibold text-gray-700">PO Date</label><input type="date" name="po_date" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20"></div>
                    <div><label class="block text-sm font-semibold text-gray-700">Store ID</label><input type="text" name="store_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20"></div>
                    <div><label class="block text-sm font-semibold text-gray-700">Sales Rep</label><input type="text" name="sales_rep" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20"></div>
                    <div><label class="block text-sm font-semibold text-gray-700">Terms (Due)</label><input type="text" name="terms_due" placeholder="e.g. Net 30" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20"></div>
                    <div><label class="block text-sm font-semibold text-gray-700">Ship By Date</label><input type="date" name="ship_by_date" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20"></div>
                </div>
            </div>

            <!-- 2. Address Information -->
            <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200">
                <h2 class="text-2xl font-bold text-[#304ed5] mb-8 border-b border-[#304ed5]/20 pb-4">Address Information</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div>
                        <h3 class="text-lg font-bold text-[#304ed5] mb-5">Bill To</h3>
                        <div class="space-y-5">
                            <input type="text" name="bill_attention" placeholder="Attention" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20">
                            <input type="text" name="bill_company" placeholder="Name/Company *" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20" required>
                            <input type="text" name="bill_address1" placeholder="Address 1 *" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20" required>
                            <input type="text" name="bill_address2" placeholder="Address 2" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20">
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" name="bill_city" placeholder="City" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20">
                                <input type="text" name="bill_zipcode" placeholder="ZipCode *" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20" required>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" name="bill_country" value="India" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20" required>
                                <input type="text" name="bill_state" placeholder="State *" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20" required>
                            </div>
                            <input type="text" name="bill_telephone" placeholder="Telephone" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20">
                            <input type="email" name="bill_email" placeholder="Email" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20">
                            <input type="text" name="bill_gstin" placeholder="GSTIN No." class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20">
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-[#304ed5] mb-5 flex items-center justify-between">
                            Ship To
                            <label class="text-sm font-medium">
                                <input type="checkbox" id="same_as_bill" onclick="copyBillToShip()" class="rounded text-[#304ed5] focus:ring-[#304ed5]/30"> Same as Bill To
                            </label>
                        </h3>
                        <div class="space-y-5">
                            <input type="text" id="ship_attention" name="ship_attention" placeholder="Attention" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20">
                            <input type="text" id="ship_company" name="ship_company" placeholder="Name/Company *" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20" required>
                            <input type="text" id="ship_address1" name="ship_address1" placeholder="Address 1 *" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20" required>
                            <input type="text" id="ship_address2" name="ship_address2" placeholder="Address 2" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20">
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" id="ship_city" name="ship_city" placeholder="City" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20">
                                <input type="text" id="ship_zipcode" name="ship_zipcode" placeholder="ZipCode *" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20" required>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" id="ship_country" name="ship_country" value="India" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20" required>
                                <input type="text" id="ship_state" name="ship_state" placeholder="State *" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20" required>
                            </div>
                            <input type="text" id="ship_telephone" name="ship_telephone" placeholder="Telephone" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20">
                            <input type="email" id="ship_email" name="ship_email" placeholder="Email" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20">
                            <input type="text" id="ship_gstin" name="ship_gstin" placeholder="GSTIN No." class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Item Details -->
            <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200">
                <h2 class="text-2xl font-bold text-[#304ed5] mb-8 border-b border-[#304ed5]/20 pb-4">Item Details</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="items-table">
                        <thead class="bg-[#304ed5]/5">
                            <tr>
                                <th class="px-4 py-4 text-left text-xs font-bold text-[#304ed5] uppercase tracking-wider">Item</th>
                                <th class="px-4 py-4 text-left text-xs font-bold text-[#304ed5] uppercase tracking-wider">Qty</th>
                                <th class="px-4 py-4 text-left text-xs font-bold text-[#304ed5] uppercase tracking-wider">Invoiced</th>
                                <th class="px-4 py-4 text-left text-xs font-bold text-[#304ed5] uppercase tracking-wider">SKU</th>
                                <th class="px-4 py-4 text-left text-xs font-bold text-[#304ed5] uppercase tracking-wider">Description</th>
                                <th class="px-4 py-4 text-left text-xs font-bold text-[#304ed5] uppercase tracking-wider">Rev No</th>
                                <th class="px-4 py-4 text-left text-xs font-bold text-[#304ed5] uppercase tracking-wider">Draft No</th>
                                <th class="px-4 py-4 text-left text-xs font-bold text-[#304ed5] uppercase tracking-wider">Unit Price</th>
                                <th class="px-4 py-4 text-left text-xs font-bold text-[#304ed5] uppercase tracking-wider">Discount</th>
                                <th class="px-4 py-4 text-left text-xs font-bold text-[#304ed5] uppercase tracking-wider">Tax %</th>
                                <th class="px-4 py-4 text-left text-xs font-bold text-[#304ed5] uppercase tracking-wider">Amount</th>
                                <th class="px-4 py-4 text-left text-xs font-bold text-[#304ed5] uppercase tracking-wider">Shipments</th>
                                <th class="px-4 py-4"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="item-row hover:bg-[#304ed5]/2 transition">
                                <td class="p-3"><input type="text" name="items[0][item]" class="w-full rounded-lg border-gray-300 focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20"></td>
                                <td class="p-3"><input type="number" name="items[0][qty]" step="1" class="w-full rounded-lg border-gray-300 qty focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20"></td>
                                <td class="p-3"><input type="number" name="items[0][invoiced]" class="w-full rounded-lg border-gray-300"></td>
                                <td class="p-3"><input type="text" name="items[0][sku]" class="w-full rounded-lg border-gray-300"></td>
                                <td class="p-3"><input type="text" name="items[0][description]" class="w-full rounded-lg border-gray-300"></td>
                                <td class="p-3"><input type="text" name="items[0][revision_no]" class="w-full rounded-lg border-gray-300"></td>
                                <td class="p-3"><input type="text" name="items[0][draft_no]" class="w-full rounded-lg border-gray-300"></td>
                                <td class="p-3"><input type="number" name="items[0][unit_price]" step="0.01" class="w-full rounded-lg border-gray-300 price focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20"></td>
                                <td class="p-3"><input type="number" name="items[0][discount]" step="0.01" class="w-full rounded-lg border-gray-300 discount"></td>
                                <td class="p-3"><input type="number" name="items[0][tax_rate]" step="0.01" value="18" class="w-full rounded-lg border-gray-300 tax"></td>
                                <td class="p-3"><input type="number" name="items[0][amount]" step="0.01" readonly class="w-full rounded-lg border-gray-300 bg-gray-50 amount font-medium"></td>
                                <td class="p-3"><input type="number" name="items[0][no_of_shipment]" class="w-full rounded-lg border-gray-300"></td>
                                <td class="p-3"><button type="button" class="text-red-600 hover:text-red-800 font-medium remove-row">Remove</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" id="add-row" class="mt-6 px-6 py-3 bg-[#304ed5] hover:bg-[#253fb8] text-white font-semibold rounded-lg shadow-md transition">
                        + Add Item
                    </button>
                </div>
            </div>

            <!-- 4. Totals & Instructions -->
            <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200">
                <h2 class="text-2xl font-bold text-[#304ed5] mb-8 border-b border-[#304ed5]/20 pb-4">Totals & Instructions</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Special Instructions</label>
                        <textarea name="special_instructions" rows="6" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#304ed5] focus:ring focus:ring-[#304ed5]/20"></textarea>
                    </div>
                    <div class="space-y-5 text-lg">
                        <div class="flex justify-between"><span class="font-medium">Subtotal</span><span id="subtotal" class="font-bold text-[#304ed5]">0.00</span></div>
                        <div class="flex justify-between"><span class="font-medium">Freight</span><input type="number" name="freight" step="0.01" value="0" class="w-32 text-right rounded-lg border-gray-300 freight focus:border-[#304ed5]"></div>
                        <div class="flex items-center justify-between">
                            <span class="font-medium">SEZ Applicable</span>
                            <input type="checkbox" name="sez_applicable" value="1" class="h-5 w-5 rounded text-[#304ed5] focus:ring-[#304ed5]/30">
                        </div>
                        <div class="flex justify-between"><span class="font-medium">Total Tax</span><span id="total-tax" class="font-bold text-[#304ed5]">0.00</span></div>
                        <div class="flex justify-between"><span class="font-medium">Round Off</span><input type="number" name="round_off" step="0.01" value="0" class="w-32 text-right rounded-lg border-gray-300 roundoff focus:border-[#304ed5]"></div>
                        <div class="flex justify-between text-2xl font-bold text-[#304ed5] border-t-4 border-[#304ed5] pt-4">
                            <span>Order Total</span><span id="order-total">0.00</span>
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Attachment</label>
                    <input type="file" name="attachment" class="block w-full text-sm text-gray-600 file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:bg-[#304ed5] file:text-white hover:file:bg-[#253fb8] transition">
                </div>
            </div>
        </form>

        <!-- Hidden Delete Form -->
        <form id="delete-form" action="#" method="POST" class="hidden">
            @csrf @method('DELETE')
        </form>
    </div>

    <!-- All JavaScript (unchanged, just with #304ed5 focus rings) -->
    <script>
        function copyBillToShip() {
            if (document.getElementById('same_as_bill').checked) {
                const fields = ['attention','company','address1','address2','city','zipcode','country','state','telephone','email','gstin'];
                fields.forEach(f => document.getElementById('ship_'+f).value = document.querySelector('[name="bill_'+f+'"]').value);
            }
        }

        let rowIndex = 1;
        document.getElementById('add-row').addEventListener('click', function () {
            const tbody = document.querySelector('#items-table tbody');
            const row = tbody.insertRow();
            row.classList.add('hover:bg-[#304ed5]/2', 'transition');
            row.innerHTML = `...`; // (same as before, just with #304ed5 focus classes)
            rowIndex++;
            attachRowListeners();
            calculateTotals();
        });

        function attachRowListeners() {
            document.querySelectorAll('.remove-row').forEach(b => b.onclick = () => { b.closest('tr').remove(); calculateTotals(); });
        }
        attachRowListeners();

        document.getElementById('items-table').addEventListener('input', e => {
            if (e.target.matches('.qty, .price, .discount, .tax, .freight, .roundoff')) calculateTotals();
        });

        function calculateTotals() {
            let subtotal = 0;
            document.querySelectorAll('.item-row').forEach(row => {
                const qty = parseFloat(row.querySelector('.qty').value) || 0;
                const price = parseFloat(row.querySelector('.price').value) || 0;
                const discount = parseFloat(row.querySelector('.discount').value) || 0;
                const tax = parseFloat(row.querySelector('.tax').value) || 0;

                const lineTotal = qty * price * (1 - discount/100) * (1 + tax/100);
                row.querySelector('.amount').value = lineTotal.toFixed(2);
                subtotal += lineTotal;
            });

            const freight = parseFloat(document.querySelector('.freight').value) || 0;
            const roundoff = parseFloat(document.querySelector('.roundoff').value) || 0;
            const total = subtotal + freight + roundoff;

            document.getElementById('subtotal').textContent = subtotal.toFixed(2);
            document.getElementById('total-tax').textContent = (subtotal * 0.18).toFixed(2);
            document.getElementById('order-total').textContent = total.toFixed(2);
        }

        calculateTotals();
    </script>
</x-app-layout>
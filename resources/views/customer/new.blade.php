<x-app-layout>
    {{-- ==== ALPINE ROOT – ONE PLACE ONLY ==== --}}
<div x-data="customerForm">
        <div class="max-w-7xl mx-auto p-4">
            {{-- ==== ACTION BAR ==== --}}
            <div class="flex items-center gap-3 mb-8">
                <button type="button" @click="history.back()"
                    class="group flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow">
                    <svg class="w-4.5 h-4.5 text-gray-500 group-hover:text-gray-700 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span>Back</span>
                </button>

                <button type="button" @click="saveAll()"
                    class="group flex items-center gap-2.5 px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-[#3251dd] to-[#2a45b8] rounded-xl hover:shadow-lg hover:shadow-[#3251dd]/30 transition-all duration-300 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                    </svg>
                    <span>Save All</span>
                </button>
            </div>
            {{-- ==== MAIN TABS ==== --}}
            <div class="mb-6">
                <ul class="flex space-x-6 border-b border-gray-200">
                    <li class="cursor-pointer pb-3 px-1 transition-all duration-200 ease-in-out"
                        :class="{'border-b-3 border-[#3251dd] text-[#3251dd] font-semibold shadow-sm': activeTab === 0, 'text-gray-500 hover:text-[#3251dd]': activeTab !== 0}"
                        @click="activeTab = 0">
                        <span class="text-sm tracking-wide">General</span>
                    </li>
                    <li class="cursor-pointer pb-3 px-1 transition-all duration-200 ease-in-out"
                        :class="{'border-b-3 border-[#3251dd] text-[#3251dd] font-semibold shadow-sm': activeTab === 1, 'text-gray-500 hover:text-[#3251dd]': activeTab !== 1}"
                        @click="activeTab = 1">
                        <span class="text-sm tracking-wide">Contacts</span>
                    </li>
                    <li class="cursor-pointer pb-3 px-1 transition-all duration-200 ease-in-out"
                        :class="{'border-b-3 border-[#3251dd] text-[#3251dd] font-semibold shadow-sm': activeTab === 2, 'text-gray-500 hover:text-[#3251dd]': activeTab !== 2}"
                        @click="activeTab = 2">
                        <span class="text-sm tracking-wide">History</span>
                    </li>
                    <li class="cursor-pointer pb-3 px-1 transition-all duration-200 ease-in-out"
                        :class="{'border-b-3 border-[#3251dd] text-[#3251dd] font-semibold shadow-sm': activeTab === 3, 'text-gray-500 hover:text-[#3251dd]': activeTab !== 3}"
                        @click="activeTab = 3">
                        <span class="text-sm tracking-wide">Address Book</span>
                    </li>
                    <li class="cursor-pointer pb-3 px-1 transition-all duration-200 ease-in-out"
                        :class="{'border-b-3 border-[#3251dd] text-[#3251dd] font-semibold shadow-sm': activeTab === 4, 'text-gray-500 hover:text-[#3251dd]': activeTab !== 4}"
                        @click="activeTab = 4">
                        <span class="text-sm tracking-wide">Notes</span>
                    </li>
                </ul>
            </div>

            {{-- ==== TAB CONTENTS ==== --}}

            {{-- ==== GENERAL TAB (with sub-tabs) ==== --}}
            <div x-show="activeTab === 0" x-transition class="space-y-8">
                <h2 class="text-2xl font-bold text-[#151e31]">General</h2>

                {{-- SUB-MENU --}}
                <div class="flex flex-wrap gap-5 -mb-px">
                    @php
                        $subItems = [
                            'Contact Information',
                            'Main Mailing Address',
                            'Instructions',
                            'Other Information',
                            'Attachments',
                            'More Information'
                        ];
                    @endphp
                    @foreach($subItems as $idx => $label)
                        <button type="button"
                            class="pb-3 px-2 text-sm font-medium tracking-wide transition-all duration-200 border-b-2"
                            :class="{
                                'border-[#3251dd] text-[#3251dd] font-semibold': activeSubTab === {{ $idx }},
                                'border-transparent text-gray-500 hover:text-[#3251dd] hover:border-[#3251dd]/50': activeSubTab !== {{ $idx }}
                            }"
                            @click="activeSubTab = {{ $idx }}">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
                {{-- SUB-TAB CONTENT --}}
                <div class="mt-8 bg-white rounded-xl shadow-lg p-8 border border-gray-100">

                    {{-- CONTACT INFORMATION --}}
                    <div x-show="activeSubTab === 0" x-transition>
                        <h3 class="text-lg font-semibold text-[#151e31] mb-6">Contact Information</h3>
                        <div x-show="editing[0]" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Customer ID</label><input type="text" x-model="form.contact.customer_id" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">File Number</label><input type="text" x-model="form.contact.file_number" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">First Name</label><input type="text" x-model="form.contact.first_name" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Middle Name</label><input type="text" x-model="form.contact.middle_name" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Last Name</label><input type="text" x-model="form.contact.last_name" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">PAN Number</label><input type="text" x-model="form.contact.pan_number" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">ECC Number</label><input type="text" x-model="form.contact.ecc_number" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">SEZ Number</label><input type="text" x-model="form.contact.sez_number" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div class="md:col-span-2 space-y-4">
                                    <div class="flex flex-wrap gap-6 justify-start">
                                        <label class="flex items-center space-x-2"><input type="checkbox" x-model="form.contact.sez_applicable" class="rounded text-[#3251dd] h-5 w-5 focus:ring-[#3251dd]"><span class="text-sm font-medium">SEZ Applicable</span></label>
                                        <label class="flex items-center space-x-2"><input type="checkbox" x-model="form.contact.tcs_applicable" class="rounded text-[#3251dd] h-5 w-5 focus:ring-[#3251dd]"><span class="text-sm font-medium">TCS Applicable</span></label>
                                        <label class="flex items-center space-x-2"><input type="checkbox" x-model="form.contact.tds_applicable" class="rounded text-[#3251dd] h-5 w-5 focus:ring-[#3251dd]"><span class="text-sm font-medium">TDS Applicable</span></label>
                                        <label class="flex items-center space-x-2"><input type="checkbox" x-model="form.contact.delivery_date_applicable" class="rounded text-[#3251dd] h-5 w-5 focus:ring-[#3251dd]"><span class="text-sm font-medium">Delivery Date Applicable</span></label>
                                        <label class="flex items-center space-x-2"><input type="checkbox" x-model="form.contact.inactive" class="rounded text-[#3251dd] h-5 w-5 focus:ring-[#3251dd]"><span class="text-sm font-medium">Inactive</span></label>
                                    </div>
                                </div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Currency</label>
                                    <select x-model="form.contact.currency" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                                        <option value="">Select Currency</option>
                                        <option value="INR">INR</option>
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                        <option value="GBP">GBP</option>
                                    </select>
                                </div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Sales Rep ID</label>
                                    <select x-model="form.contact.sales_rep_id" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                                        <option value="">Select</option>
                                        <option value="SR001">SR001</option>
                                        <option value="SR002">SR002</option>
                                    </select>
                                </div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Category</label>
                                    <select x-model="form.contact.category" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                                        <option value="">Select</option>
                                        <option value="Retail">Retail</option>
                                        <option value="Wholesale">Wholesale</option>
                                    </select>
                                </div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Account Number</label><input type="text" x-model="form.contact.account_number" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Default Price Sheet</label>
                                    <select x-model="form.contact.default_price_sheet" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                                        <option value="">Select</option>
                                        <option value="Standard">Standard</option>
                                    </select>
                                </div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Default Sales Tax</label>
                                    <select x-model="form.contact.default_sales_tax" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                                        <option value="">Select</option>
                                        <option value="GST18">GST 18%</option>
                                    </select>
                                </div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Tin Number</label><input type="text" x-model="form.contact.tin_number" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Payment Terms</label>
                                    <select x-model="form.contact.payment_terms" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                                        <option value="">Select</option>
                                        <option value="Net30">Net 30</option>
                                    </select>
                                </div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Export Special Terms</label><input type="text" x-model="form.contact.export_special_terms" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Order Acknowledgement</label>
                                    <select x-model="form.contact.order_acknowledgement" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                                        <option value="">Select</option>
                                        <option value="Email">Email</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div x-show="!editing[0]" class="text-center py-8 text-gray-500">
                            <p>Form saved. Click <button @click="editing[0] = true" class="text-[#3251dd] underline font-medium">Edit</button> to modify.</p>
                        </div>
                    </div>

                    {{-- MAIN MAILING ADDRESS --}}
                    <div x-show="activeSubTab === 1" x-transition>
                        <h3 class="text-lg font-semibold text-[#151e31] mb-6">Main Mailing Address</h3>
                        <div x-show="editing[1]" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Name/Company</label><input type="text" x-model="form.address.company_name" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Attention</label><input type="text" x-model="form.address.attention" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Address 1</label><input type="text" x-model="form.address.address1" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Address 2</label><input type="text" x-model="form.address.address2" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">City</label><input type="text" x-model="form.address.city" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Region</label><input type="text" x-model="form.address.region" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Country</label><input type="text" x-model="form.address.country" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">State</label><input type="text" x-model="form.address.state" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">GSTIN Number</label><input type="text" x-model="form.address.gstin_number" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">ARN Number</label><input type="text" x-model="form.address.arn_number" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">UIN Number</label><input type="text" x-model="form.address.uin_number" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Telephone</label><input type="text" x-model="form.address.telephone" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Alt Telephone</label><input type="text" x-model="form.address.alt_telephone" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Fax</label><input type="text" x-model="form.address.fax" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Mobile Phone</label><input type="text" x-model="form.address.mobile_phone" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label><input type="email" x-model="form.address.email" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Website</label><input type="text" x-model="form.address.website" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Zip Code</label><input type="text" x-model="form.address.zipcode" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            </div>
                        </div>
                        <div x-show="!editing[1]" class="text-center py-8 text-gray-500">
                            <p>Form saved. Click <button @click="editing[1] = true" class="text-[#3251dd] underline font-medium">Edit</button> to modify.</p>
                        </div>
                    </div>

                    {{-- INSTRUCTIONS --}}
                    <div x-show="activeSubTab === 2" x-transition>
                        <h3 class="text-lg font-semibold text-[#151e31] mb-6">Instructions</h3>
                        <div x-show="editing[2]" class="space-y-6">
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Instruction For Courier</label><textarea x-model="form.instructions.instruction_courier" rows="4" class="mt-1 block w-full md:max-w-2xl border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></textarea></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Instruction For Dispatcher</label><textarea x-model="form.instructions.instruction_dispatcher" rows="4" class="mt-1 block w-full md:max-w-2xl border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></textarea></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Instruction For Production</label><textarea x-model="form.instructions.instruction_production" rows="4" class="mt-1 block w-full md:max-w-2xl border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></textarea></div>
                        </div>
                        <div x-show="!editing[2]" class="text-center py-8 text-gray-500">
                            <p>Instructions saved. Click <button @click="editing[2] = true" class="text-[#3251dd] underline font-medium">Edit</button> to modify.</p>
                        </div>
                    </div>
                    {{-- OTHER INFORMATION --}}
                    <div x-show="activeSubTab === 3" x-transition>
                        <h3 class="text-lg font-semibold text-[#151e31] mb-6">Other Information</h3>
                        <div x-show="editing[3]" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Rate Contract</label><input type="text" x-model="form.other.rate_contract" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Mode Of Dispatch</label><input type="text" x-model="form.other.mode_of_dispatch" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Courier Name</label><input type="text" x-model="form.other.courier_name" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Delivery Charges</label><input type="text" x-model="form.other.delivery_charges" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div class="flex items-center space-x-2"><input type="checkbox" x-model="form.other.excise_duty_applicable" class="rounded text-[#3251dd] h-5 w-5 focus:ring-[#3251dd]"><span class="text-sm font-medium">Is Excise Duty Applicable</span></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Discount Given</label><input type="text" x-model="form.other.discount_given" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Sales Tax Form</label><input type="text" x-model="form.other.sales_tax_form" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Full Sales Tax</label><input type="text" x-model="form.other.full_sales_tax" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            </div>
                        </div>
                        <div x-show="!editing[3]" class="text-center py-8 text-gray-500">
                            <p>Other info saved. Click <button @click="editing[3] = true" class="text-[#3251dd] underline font-medium">Edit</button> to modify.</p>
                        </div>
                    </div>
                    {{-- ATTACHMENTS --}}
                    <div x-show="activeSubTab === 4" x-transition>
                        <h3 class="text-lg font-semibold text-[#151e31] mb-6">Attachments</h3>
                        <div x-show="editing[4]" class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Select file to attach:</label>
                                <input type="file"
                                    @change="form.attachments.list.push({ name: $event.target.files[0].name, url: '#' })"
                                    class="block w-full text-sm text-gray-600 file:mr-4 file:py-2.5 file:px-5 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#3251dd]/10 file:text-[#3251dd] hover:file:bg-[#3251dd]/20 transition-all">
                            </div>
                            <div class="border-t pt-6">
                                <template x-if="form.attachments.list.length > 0">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Name</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <template x-for="file in form.attachments.list" :key="file.name">
                                                <tr>
                                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900" x-text="file.name"></td>
                                                    <td class="px-6 py-3 whitespace-nowrap text-sm">
                                                        <button type="button"
                                                            @click="form.attachments.list = form.attachments.list.filter(f => f.name !== file.name)"
                                                            class="text-red-600 hover:text-red-800 font-medium">Remove</button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </template>
                                <template x-if="form.attachments.list.length === 0">
                                    <p class="text-gray-400 text-center py-10 italic">No documents attached yet.</p>
                                </template>
                            </div>
                        </div>
                        <div x-show="!editing[4]" class="text-center py-8 text-gray-500">
                            <p>Attachments saved. Click <button @click="editing[4] = true" class="text-[#3251dd] underline font-medium">Edit</button> to modify.</p>
                        </div>
                    </div>
                    {{-- MORE INFORMATION --}}
                    <div x-show="activeSubTab === 5" x-transition>
                        <h3 class="text-lg font-semibold text-[#151e31] mb-6">More Information</h3>
                        <div x-show="editing[5]" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">TAN</label><input type="text" x-model="form.more.tan" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">IEC</label><input type="text" x-model="form.more.iec" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Provisional Receipt Number</label><input type="text" x-model="form.more.provisional_receipt_number" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Old Company Name</label><input type="text" x-model="form.more.old_company_name" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Bank Account No.</label><input type="text" x-model="form.more.bank_account_no" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">MSME</label><input type="text" x-model="form.more.msme" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">CIN</label><input type="text" x-model="form.more.cin" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Group ID</label><input type="text" x-model="form.more.group_id" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">IFSC Code</label><input type="text" x-model="form.more.ifsc_code" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            </div>
                        </div>
                        <div x-show="!editing[5]" class="text-center py-8 text-gray-500">
                            <p>More info saved. Click <button @click="editing[5] = true" class="text-[#3251dd] underline font-medium">Edit</button> to modify.</p>
                        </div>
                    </div>
                </div>
            </div>
{{-- ==== CONTACTS TAB ==== --}}
<div x-show="activeTab === 1" x-transition>
    <div class="p-8 bg-white rounded-xl shadow-lg border border-gray-100">
        <h2 class="text-2xl font-bold text-[#151e31] mb-6">Contacts</h2>

        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Title</label>
                    <input type="text" x-model="form.contact.title"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- First Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">First Name</label>
                    <input type="text" x-model="form.contact.first_name"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- Last Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Last Name</label>
                    <input type="text" x-model="form.contact.last_name"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- Contact ID -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Contact ID</label>
                    <input type="text" x-model="form.contact.contact_id"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- Facebook ID -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Facebook ID</label>
                    <input type="text" x-model="form.contact.facebook_id"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- Twitter ID -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Twitter ID</label>
                    <input type="text" x-model="form.contact.twitter_id"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- Name/Company -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Name/Company</label>
                    <input type="text" x-model="form.contact.company_name"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- Attention -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Attention</label>
                    <input type="text" x-model="form.contact.attention"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- Address1 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Address 1</label>
                    <input type="text" x-model="form.contact.address1"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- Address2 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Address 2</label>
                    <input type="text" x-model="form.contact.address2"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- City -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">City</label>
                    <input type="text" x-model="form.contact.city"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- Region -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Region</label>
                    <input type="text" x-model="form.contact.region"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- Country -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Country</label>
                    <input type="text" x-model="form.contact.country"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- State -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">State</label>
                    <input type="text" x-model="form.contact.state"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- GSTIN Number -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">GSTIN Number</label>
                    <input type="text" x-model="form.contact.gstin_number"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- ARN Number -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">ARN Number</label>
                    <input type="text" x-model="form.contact.arn_number"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- UIN Number -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">UIN Number</label>
                    <input type="text" x-model="form.contact.uin_number"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- Telephone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Telephone</label>
                    <input type="text" x-model="form.contact.telephone"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- Alt Telephone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Alt Telephone</label>
                    <input type="text" x-model="form.contact.alt_telephone"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- Fax -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Fax</label>
                    <input type="text" x-model="form.contact.fax"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- Mobile Phone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Mobile Phone</label>
                    <input type="text" x-model="form.contact.mobile_phone"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <input type="email" x-model="form.contact.email"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- Website -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Website</label>
                    <input type="text" x-model="form.contact.website"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

                <!-- ZipCode -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">ZipCode</label>
                    <input type="text" x-model="form.contact.zipcode"
                        class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all">
                </div>

            </div>
        </div>
    </div>
</div>

            {{-- ==== HISTORY TAB ==== --}}
            <div x-show="activeTab === 2" x-transition>
                <div class="p-8 bg-white rounded-xl shadow-lg">
                    <h2 class="text-2xl font-bold text-[#151e31] mb-4">History</h2>
                    <p class="text-gray-600">Order and transaction history.</p>
                </div>
            </div>

            {{-- ==== ADDRESS BOOK TAB ==== --}}
            <div x-show="activeTab === 3" x-transition class="space-y-8">
                <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                    <h2 class="text-2xl font-bold text-[#151e31] mb-6">Address Book</h2>

                    {{-- SUB TABS: Shipping & Billing --}}
                    <div class="flex space-x-6 border-b border-gray-200 mb-8">
                        <button @click="addressTab = 'shipping'"
                            class="pb-3 px-1 text-sm font-medium transition-all duration-200"
                            :class="{'border-b-3 border-[#3251dd] text-[#3251dd] font-semibold': addressTab === 'shipping', 'text-gray-500 hover:text-[#3251dd]': addressTab !== 'shipping'}">
                            Shipping Addresses
                        </button>
                        <button @click="addressTab = 'billing'"
                            class="pb-3 px-1 text-sm font-medium transition-all duration-200"
                            :class="{'border-b-3 border-[#3251dd] text-[#3251dd] font-semibold': addressTab === 'billing', 'text-gray-500 hover:text-[#3251dd]': addressTab !== 'billing'}">
                            Billing Addresses
                        </button>
                    </div>

                    {{-- SHIPPING ADDRESS FORM --}}
                    <div x-show="addressTab === 'shipping'" x-transition>
                        <h3 class="text-lg font-semibold text-[#151e31] mb-6">Shipping Address</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Name/Company</label><input type="text" x-model="form.address.shipping.company_name" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Attention</label><input type="text" x-model="form.address.shipping.attention" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Address 1</label><input type="text" x-model="form.address.shipping.address1" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Address 2</label><input type="text" x-model="form.address.shipping.address2" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">City</label><input type="text" x-model="form.address.shipping.city" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Region</label><input type="text" x-model="form.address.shipping.region" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Country</label><input type="text" x-model="form.address.shipping.country" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">State</label><input type="text" x-model="form.address.shipping.state" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">GSTIN Number</label><input type="text" x-model="form.address.shipping.gstin_number" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">ARN Number</label><input type="text" x-model="form.address.shipping.arn_number" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">UIN Number</label><input type="text" x-model="form.address.shipping.uin_number" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Telephone</label><input type="text" x-model="form.address.shipping.telephone" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Alt Telephone</label><input type="text" x-model="form.address.shipping.alt_telephone" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Fax</label><input type="text" x-model="form.address.shipping.fax" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Mobile Phone</label><input type="text" x-model="form.address.shipping.mobile_phone" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label><input type="email" x-model="form.address.shipping.email" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Website</label><input type="text" x-model="form.address.shipping.website" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">ZipCode</label><input type="text" x-model="form.address.shipping.zipcode" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1.5">Notes</label><textarea x-model="form.address.shipping.notes" rows="3" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></textarea></div>
                        </div>
                    </div>

                    {{-- BILLING ADDRESS FORM --}}
                    <div x-show="addressTab === 'billing'" x-transition>
                        <h3 class="text-lg font-semibold text-[#151e31] mb-6">Billing Address</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Name/Company</label><input type="text" x-model="form.address.billing.company_name" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Attention</label><input type="text" x-model="form.address.billing.attention" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Address 1</label><input type="text" x-model="form.address.billing.address1" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Address 2</label><input type="text" x-model="form.address.billing.address2" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">City</label><input type="text" x-model="form.address.billing.city" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Region</label><input type="text" x-model="form.address.billing.region" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Country</label><input type="text" x-model="form.address.billing.country" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">State</label><input type="text" x-model="form.address.billing.state" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">GSTIN Number</label><input type="text" x-model="form.address.billing.gstin_number" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">ARN Number</label><input type="text" x-model="form.address.billing.arn_number" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">UIN Number</label><input type="text" x-model="form.address.billing.uin_number" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Telephone</label><input type="text" x-model="form.address.billing.telephone" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Alt Telephone</label><input type="text" x-model="form.address.billing.alt_telephone" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Fax</label><input type="text" x-model="form.address.billing.fax" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Mobile Phone</label><input type="text" x-model="form.address.billing.mobile_phone" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label><input type="email" x-model="form.address.billing.email" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Website</label><input type="text" x-model="form.address.billing.website" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">ZipCode</label><input type="text" x-model="form.address.billing.zipcode" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></div>
                            <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1.5">Notes</label><textarea x-model="form.address.billing.notes" rows="3" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd] transition-all"></textarea></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ==== NOTES TAB ==== --}}
            <div x-show="activeTab === 4" x-transition>
                <div class="p-8 bg-white rounded-xl shadow-lg border border-gray-100 space-y-8">
                    <h2 class="text-2xl font-bold text-[#151e31] mb-6">Notes</h2>

                    {{-- ADD NOTE FORM --}}
                    <div class="bg-gray-50 p-6 rounded-lg border">
                        <h3 class="text-lg font-semibold text-[#151e31] mb-4">Add Note</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Sales Rep</label>
                                <select x-model="form.notes.new.sales_rep" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd]">
                                    <option value="SR001">SR001 - John</option>
                                    <option value="SR002">SR002 - Jane</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Date</label>
                                <input type="date" x-model="form.notes.new.date" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd]">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Action</label>
                                <input type="text" x-model="form.notes.new.action" placeholder="e.g., Called, Email sent" class="mt-1 block w-full md:max-w-md border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd]">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Notes</label>
                                <textarea x-model="form.notes.new.notes" rows="3" placeholder="Enter detailed notes..." class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-3 text-base focus:ring-2 focus:ring-[#3251dd] focus:border-[#3251dd]"></textarea>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button @click="addNote()" class="px-5 py-2.5 text-sm font-medium text-white bg-[#3251dd] rounded-lg hover:bg-[#2a45b8] transition-all">
                                Add Note
                            </button>
                        </div>
                    </div>

                    {{-- SALES ORDER HISTORY TABLE --}}
                    <div>
                        <h3 class="text-lg font-semibold text-[#151e31] mb-4">Sales Order History (Most Recent 40 Results)</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Delete</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sales Rep</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notes</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <template x-for="note in form.notes.list.slice(0, 40)" :key="note.id">
                                        <tr>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <button @click="deleteNote(note.id)" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900" x-text="note.sales_rep"></td>
                                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900" x-text="note.date"></td>
                                            <td class="px-6 py-3 text-sm text-gray-900" x-text="note.action"></td>
                                            <td class="px-6 py-3 text-sm text-gray-600" x-text="note.notes"></td>
                                        </tr>
                                    </template>
                                    <template x-if="form.notes.list.length === 0">
                                        <tr>
                                            <td colspan="5" class="px-6 py-10 text-center text-gray-500 italic">No notes added yet.</td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('customerForm', () => ({
            // === State ===
            activeTab: 0,
            activeSubTab: 0,
            addressTab: 'shipping',
            editing: [true, true, true, true, true, true],

            // === Form Data – EMPTY on load ===
            form: {
                contact: {
                    customer_id: '', file_number: '', first_name: '', middle_name: '', last_name: '',
                    pan_number: '', ecc_number: '', sez_number: '',
                    sez_applicable: false, tcs_applicable: false, tds_applicable: false,
                    delivery_date_applicable: false, inactive: false,
                    currency: '', sales_rep_id: '', category: '',
                    account_number: '', default_price_sheet: '',
                    default_sales_tax: '', tin_number: '', payment_terms: '',
                    export_special_terms: '', order_acknowledgement: '',
                    // Contacts tab
                    title: '', contact_id: '', facebook_id: '', twitter_id: '',
                    company_name: '', attention: '', address1: '',
                    address2: '', city: '', region: '', country: '',
                    state: '', gstin_number: '', arn_number: '',
                    uin_number: '', telephone: '', alt_telephone: '',
                    fax: '', mobile_phone: '', email: '',
                    website: '', zipcode: ''
                },
                address: {
                    company_name: '', attention: '', address1: '',
                    address2: '', city: '', region: '', country: '',
                    state: '', gstin_number: '', arn_number: '',
                    uin_number: '', telephone: '', alt_telephone: '',
                    fax: '', mobile_phone: '', email: '',
                    website: '', zipcode: '',
                    shipping: {
                        company_name: '', attention: '', address1: '', address2: '',
                        city: '', region: '', country: '', state: '',
                        gstin_number: '', arn_number: '', uin_number: '',
                        telephone: '', alt_telephone: '', fax: '', mobile_phone: '',
                        email: '', website: '', zipcode: '', notes: ''
                    },
                    billing: {
                        company_name: '', attention: '', address1: '', address2: '',
                        city: '', region: '', country: '', state: '',
                        gstin_number: '', arn_number: '', uin_number: '',
                        telephone: '', alt_telephone: '', fax: '', mobile_phone: '',
                        email: '', website: '', zipcode: '', notes: ''
                    }
                },
                instructions: {
                    instruction_courier: '',
                    instruction_dispatcher: '',
                    instruction_production: ''
                },
                other: {
                    rate_contract: '', mode_of_dispatch: '',
                    courier_name: '', delivery_charges: '',
                    excise_duty_applicable: false,
                    discount_given: '', sales_tax_form: '', full_sales_tax: ''
                },
                attachments: { list: [] },
                more: {
                    tan: '', iec: '', provisional_receipt_number: '',
                    old_company_name: '', bank_account_no: '',
                    msme: '', cin: '', group_id: '', ifsc_code: ''
                },
                 notes: {
                    new: { sales_rep: '', date: '', action: '', notes: '' },
                    list: []          // stays empty until the user adds a note
                }
            },

            // === Methods (unchanged) ===
            saveAll() {
                const payload = { form: this.form };
                fetch('{{ route("customers.save") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(payload)
                })
                .then(r => r.json())
                .then(data => {
                    alert(data.message || 'Saved successfully!');
                    this.editing = this.editing.map(() => false);
                })
                .catch(err => {
                    console.error(err);
                    alert('Error saving data');
                });
            },
            addNote() {
                if (!this.form.notes.new.notes.trim()) return;
                this.form.notes.list.push({
                    id: Date.now(),
                    sales_rep: this.form.notes.new.sales_rep,
                    date: this.form.notes.new.date || new Date().toISOString().split('T')[0],
                    action: this.form.notes.new.action,
                    notes: this.form.notes.new.notes
                });
                this.form.notes.new = { sales_rep: '', date: '', action: '', notes: '' };
            },
            deleteNote(id) {
                this.form.notes.list = this.form.notes.list.filter(n => n.id !== id);
            }
        }));
    });
</script>
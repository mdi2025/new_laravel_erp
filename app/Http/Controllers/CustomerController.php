<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // GET: Show all customers
  public function index(Request $request)
{
    $customers = Customer::select([
            'customer_id',
            'first_name',
            'middle_name',
            'last_name',
            'email',
            'company_name',
            'category',
            'mobile_phone',
            'gstin_number',
            'inactive',
        ])
        ->orderBy('first_name')
        ->get();
    // If request expects JSON, return JSON
    if ($request->wantsJson()) {
        return response()->json($customers);
    }
    // Otherwise return the Blade view
    return view('customer.manager');
}
    // POST: Save (create or update) customer
    public function save(Request $request)
    {
        $request->validate([
            'form.contact.customer_id' => 'required|string|unique:customers,customer_id,' . $request->input('form.contact.customer_id') . ',customer_id',
        ]);
        $form = $request->input('form');
        $payload = [
            // --- Contact ---
            'customer_id'               => $form['contact']['customer_id'],
            'file_number'               => $form['contact']['file_number'] ?? null,
            'first_name'                => $form['contact']['first_name'],
            'middle_name'               => $form['contact']['middle_name'] ?? null,
            'last_name'                 => $form['contact']['last_name'],
            'pan_number'                => $form['contact']['pan_number'] ?? null,
            'ecc_number'                => $form['contact']['ecc_number'] ?? null,
            'sez_number'                => $form['contact']['sez_number'] ?? null,
            'sez_applicable'            => $form['contact']['sez_applicable'] ?? false,
            'tcs_applicable'            => $form['contact']['tcs_applicable'] ?? false,
            'tds_applicable'            => $form['contact']['tds_applicable'] ?? false,
            'delivery_date_applicable' => $form['contact']['delivery_date_applicable'] ?? false,
            'inactive'                  => $form['contact']['inactive'] ?? false,
            'currency'                  => $form['contact']['currency'] ?? 'INR',
            'sales_rep_id'              => $form['contact']['sales_rep_id'] ?? null,
            'category'                  => $form['contact']['category'] ?? null,
            'account_number'            => $form['contact']['account_number'] ?? null,
            'default_price_sheet'       => $form['contact']['default_price_sheet'] ?? null,
            'default_sales_tax'         => $form['contact']['default_sales_tax'] ?? null,
            'tin_number'                => $form['contact']['tin_number'] ?? null,
            'payment_terms'             => $form['contact']['payment_terms'] ?? null,
            'export_special_terms'      => $form['contact']['export_special_terms'] ?? null,
            'order_acknowledgement'     => $form['contact']['order_acknowledgement'] ?? null,

            // --- Address & Contact Info ---
            'title'                     => $form['contact']['title'] ?? null,
            'contact_id'                => $form['contact']['contact_id'] ?? null,
            'facebook_id'               => $form['contact']['facebook_id'] ?? null,
            'twitter_id'                => $form['contact']['twitter_id'] ?? null,
            'company_name'              => $form['contact']['company_name'],
            'attention'                 => $form['contact']['attention'] ?? null,
            'address1'                  => $form['contact']['address1'],
            'address2'                  => $form['contact']['address2'] ?? null,
            'city'                      => $form['contact']['city'],
            'region'                    => $form['contact']['region'] ?? null,
            'country'                   => $form['contact']['country'],
            'state'                     => $form['contact']['state'],
            'gstin_number'              => $form['contact']['gstin_number'] ?? null,
            'arn_number'                => $form['contact']['arn_number'] ?? null,
            'uin_number'                => $form['contact']['uin_number'] ?? null,
            'telephone'                 => $form['contact']['telephone'] ?? null,
            'alt_telephone'             => $form['contact']['alt_telephone'] ?? null,
            'fax'                       => $form['contact']['fax'] ?? null,
            'mobile_phone'              => $form['contact']['mobile_phone'] ?? null,
            'email'                     => $form['contact']['email'],
            'website'                   => $form['contact']['website'] ?? null,
            'zipcode'                   => $form['contact']['zipcode'] ?? null,

            // --- Instructions ---
            'instruction_courier'       => $form['instructions']['instruction_courier'] ?? null,
            'instruction_dispatcher'    => $form['instructions']['instruction_dispatcher'] ?? null,
            'instruction_production'    => $form['instructions']['instruction_production'] ?? null,

            // --- Other ---
            'rate_contract'             => $form['other']['rate_contract'] ?? null,
            'mode_of_dispatch'          => $form['other']['mode_of_dispatch'] ?? null,
            'courier_name'              => $form['other']['courier_name'] ?? null,
            'delivery_charges'          => $form['other']['delivery_charges'] ?? null,
            'excise_duty_applicable'    => $form['other']['excise_duty_applicable'] ?? false,
            'discount_given'            => $form['other']['discount_given'] ?? null,
            'sales_tax_form'            => $form['other']['sales_tax_form'] ?? null,
            'full_sales_tax'            => $form['other']['full_sales_tax'] ?? null,
            // --- Attachments ---
            'attachments'               => $form['attachments']['list'] ?? [],
            // --- More ---
            'tan'                       => $form['more']['tan'] ?? null,
            'iec'                       => $form['more']['iec'] ?? null,
            'provisional_receipt_number'=> $form['more']['provisional_receipt_number'] ?? null,
            'old_company_name'          => $form['more']['old_company_name'] ?? null,
            'bank_account_no'           => $form['more']['bank_account_no'] ?? null,
            'msme'                      => $form['more']['msme'] ?? null,
            'cin'                       => $form['more']['cin'] ?? null,
            'group_id'                  => $form['more']['group_id'] ?? null,
            'ifsc_code'                 => $form['more']['ifsc_code'] ?? null,
            // --- Address JSON ---
            'shipping_address'          => $form['address']['shipping'] ?? [],
            'billing_address'           => $form['address']['billing'] ?? [],
            // --- Notes ---
            'notes'                     => $form['notes']['list'] ?? [],
        ];

        Customer::updateOrCreate(
            ['customer_id' => $payload['customer_id']],
            $payload
        );

        return response()->json(['message' => 'Customer saved successfully!']);
    }
    
}
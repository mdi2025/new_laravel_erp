<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
public function index(Request $request)
    {
        // If the request expects JSON (our JS fetch does), return the data
        if ($request->wantsJson() || $request->header('Accept') === 'application/json') {
            $customers = DB::select("
                SELECT
                    c.id AS customer_id,
                    COALESCE(c.short_name) AS name_company,
                    a.address1,
                    a.city_town AS city,
                    a.state_province AS state,
                    a.postal_code AS zipcode,
                    c.gst_in_no AS gstin_no,
                    c.last_update,
                    c.tds_applicable,
                    c.dept_rep_id AS rep_id
                FROM contacts c
                LEFT JOIN address_book a
                    ON a.ref_id = c.id 
                ORDER BY c.id ASC, name_company ASC
            ");

            // Optional: format dates / booleans the way your JS expects
            $customers = array_map(function ($row) {
                // Cast stdClass → array for easier handling in JS
                $row = (array) $row;

                // If you have a last_update timestamp, format it nicely
                if (!empty($row['last_update'])) {
                    $row['last_update'] = \Carbon\Carbon::parse($row['last_update'])
                        ->format('d M Y, h:i A');
                }

                // Ensure boolean fields are real booleans (optional)
                $row['tds_applicable'] = (bool) $row['tds_applicable'];

                return $row;
            }, $customers);

            return response()->json($customers);
        }

        // Otherwise show the Blade view (your current page)
        return view('customer/customers/manager'); // adjust path if needed
    }


    public function save(Request $request)
    {
        $form = $request->input('form');

        DB::beginTransaction();
        try {
            $contactId = DB::table('contacts')->insertGetId([
                'type'               => 'c',
                'inactive'           => $form['contact']['inactive'] ? '1' : '0',

                // Short name
                'short_name' => !empty($form['address']['company_name'])
                    ? trim($form['address']['company_name'])
                    : trim(($form['contact']['first_name'] ?? '') . ' ' . ($form['contact']['last_name'] ?? '')),

                // Names
                'contact_first'      => $form['contact']['first_name'] ?? null,
                'contact_middle'     => $form['contact']['middle_name'] ?? null,
                'contact_last'       => $form['contact']['last_name'] ?? null,

                // Core IDs
                'account_number'     => $form['contact']['account_number'] ?? '',
                'pan_no'             => $form['contact']['pan_number'] ?? '',
                'gov_id_number'      => $form['contact']['pan_number'] ?? '',

                'mdi_cust_ecc'       => $form['contact']['ecc_number'] ?? 'NA',
                'mdi_cus_tinno'      => $form['contact']['tin_number'] ?? 'NA',
                'mdi_cus_sezno'      => $form['contact']['sez_number'] ?? 'NA',

                // GST (only these exist in contacts)
                'gst_in_no'          => $form['address']['gstin_number'] ?? '',
                'arn_no'             => $form['address']['arn_number'] ?? '',

                // Tax flags
                'sez_applicable'     => $form['contact']['sez_applicable'] ? 1 : 0,
                'tcs_applicable'     => $form['contact']['tcs_applicable'] ? 1 : 0,
                'tds_applicable'     => $form['contact']['tds_applicable'] ? 1 : 0,
                'dd_applicable'      => $form['contact']['delivery_date_applicable'] ? 1 : 0,

                // Pricing & salesperson
                'dept_rep_id'        => $form['contact']['sales_rep_id'] ?? '',   // FIXED correct column
                'category_id'        => $form['contact']['category'] ?? 0,        // FIXED correct column
                'currency_code'      => $form['contact']['currency'] ?? 'INR',
                'price_sheet'        => $form['contact']['default_price_sheet'] ?? null,
                'tax_id'             => $form['contact']['default_sales_tax'] ?? 0,

                // Terms
                'special_terms'      => $form['contact']['payment_terms'] ?? '',
                'special_terms_desc' => $form['contact']['export_special_terms'] ?? '',

                // Order acknowledgement flag (actual column)
                'ack_applicable'     => $form['contact']['order_acknowledgement'] ?? 1,

                // Instructions
                'mdi_cus_ins_courier'     => $form['instructions']['instruction_courier'] ?? null,
                'mdi_cus_ins_dispatcher'  => $form['instructions']['instruction_dispatcher'] ?? null,
                'mdi_cus_ins_production'  => $form['instructions']['instruction_production'] ?? null,

                // Other Info
                'mdi_cus_rate_contract'     => $form['other']['rate_contract'] ?? null,
                'mdi_cus_mode_dispatch'     => $form['other']['mode_of_dispatch'] ?? null,
                'mdi_cus_courier_name'      => $form['other']['courier_name'] ?? null,
                'mdi_cus_delivery_charges'  => $form['other']['delivery_charges'] ?? null,
                'mdi_cus_discount_given'    => $form['other']['discount_given'] ?? null,
                'mdi_cus_sales_tax_form'    => $form['other']['sales_tax_form'] ?? null,
                'mdi_cus_full_sales_tax'    => $form['other']['full_sales_tax'] ?? null,

                // Excise applicability (correct column)
                'mdi_cus_excise_applicable' => $form['other']['excise_duty_applicable'] ? 1 : 0,

                // More fields
                'mdi_tan'                   => $form['more']['tan'] ?? '',
                'mdi_ice'                   => $form['more']['iec'] ?? '',
                'mdi_msme'                  => $form['more']['msme'] ?? '',
                'mdi_cin'                   => $form['more']['cin'] ?? '',
                'mdi_old_company_name'      => $form['more']['old_company_name'] ?? '',
                'mdi_bank_acc_no'           => $form['more']['bank_account_no'] ?? '',
                'ifsc_code'                 => $form['more']['ifsc_code'] ?? '',
                'mdi_group_id'              => $form['more']['group_id'] ?? '',

                // Dates
                'first_date'  => date('Y-m-d'),
                'last_update' => date('Y-m-d'),
                // Required backend default fields
                'store_id'                  => '',
                'gl_type_account'           => '',
                'attachments'               => null,
                'last_date_1'               => null,
                'last_date_2'               => null,
                'material_id'               => 0,
                'cid_crm'                   => 0,
                'is_export'                 => 0,
                'occupation'                => '',
                'gender'                    => '',
                'residence_distance'        => '',
                'gen_category'              => '',
                'conveyance_mode'           => '',
                'marital_status'            => '',
                'job_title'                 => '',
                'employment_status'         => '',
                'supervisor'                => '',
                'aadhar_num'                => '',
                'document'                  => '',
                'document_name'             => '',
                'birth_date'                => null,
                'accnt_holder_name'         => '',
                'accnt_number'              => '',
                'branch_name'               => '',
                'bank_name'                 => '',
                'shift_time_id'             => '',
                'valid_upto'                => '',
                'lic_number'                => '',
                'esi_number'                => '',
                'pf_number'                 => '',
                'uan_number'                => '',
                'ppf_accnt'                 => '',
                'oab'                       => '',
                'welfare_deduction'         => '',
                'oad'                       => '',
                'account_head'              => '',
                'service_duration'          => 0,
                'break_time'                => '',
                'emp_code'                  => '',
                'punching_id'               => '',
                'joining_date'              => null,
                'bond_duration'             => '',
                'dept_name'                 => '',
                'adjustment_calculation'    => '',
                'dept_id'                   => 0,
                'esi_applicable'            => '',
                'pf_applicable'             => '',
                'imported'                  => 0,
                'payment_mode'              => 'null',
                'bonus_applicable'          => '',
                'late_coming_start_time'    => 0,
                'customer_group'            => 0,
                'late_coming_calculation'   => 'YES',
                'attendance_calculation'    => null,
                'is_sales_rep'              => 0,
                'vendor_type'               => '',
                'material'                  => '',
                'vendor_status'             => '',
                'material_type'             => '',
                'vendor_tds_category'       => '',
                'tds_section_name'          => '',
                'beneficiary'               => '',
            ]);
        // =================================================================
        // 2. Insert 3 Addresses (cm, cb, cs)
        // =================================================================
        $addresses = [
            // Main Mailing Address - cm
            [
                'ref_id'         => $contactId,
                'type'           => 'cm',
                'primary_name'   => !empty($form['address']['company_name'])
                                    ? $form['address']['company_name']
                                    : trim(($form['contact']['first_name'] ?? '') . ' ' . ($form['contact']['last_name'] ?? '')),
                'contact'        => $form['address']['attention'] ?? '',
                'address1'       => $form['address']['address1'] ?? '',
                'address2'       => $form['address']['address2'] ?? '',
                'city_town'      => $form['address']['city'] ?? '',
                'region_id'      => !empty($form['address']['region_id']) ? (int)$form['address']['region_id'] : 0,
                'state_province' => $form['address']['state'] ?? '',
                'postal_code'    => $form['address']['zipcode'] ?? '',
                'country_code'   => 'IN',
                'telephone1'     => $form['address']['telephone'] ?? null,
                'telephone2'     => $form['address']['alt_telephone'] ?? null,
                'telephone3'     => $form['address']['fax'] ?? null,
                'telephone4'     => $form['address']['mobile_phone'] ?? null,
                'email'          => $form['address']['email'] ?? null,
                'website'        => $form['address']['website'] ?? null,
                'gst_in_number'  => $form['address']['gstin_number'] ?? '',
                'arn_number'     => $form['address']['arn_number'] ?? '',
                'uin_number'     => $form['address']['uin_number'] ?? '',
                'notes'          => null,

                // Required NOT NULL family fields
                'family_contact_no' => '',
                'family_alt_no'     => '',
                'family_address'    => '',
                'family_member'     => '',
                'father_name'       => '',
                'mother_name'       => '',
            ],

            // Billing Address - cb
            [
                'ref_id'         => $contactId,
                'type'           => 'cb',
                'primary_name'   => !empty($form['address']['billing']['company_name'])
                                    ? $form['address']['billing']['company_name']
                                    : (!empty($form['address']['company_name'])
                                        ? $form['address']['company_name']
                                        : trim(($form['contact']['first_name'] ?? '') . ' ' . ($form['contact']['last_name'] ?? ''))),
                'contact'        => $form['address']['billing']['attention'] ?? '',
                'address1'       => $form['address']['billing']['address1'] ?? '',
                'address2'       => $form['address']['billing']['address2'] ?? '',
                'city_town'      => $form['address']['billing']['city'] ?? '',
                'region_id'      => !empty($form['address']['billing']['region_id']) ? (int)$form['address']['billing']['region_id'] : 0,
                'state_province' => $form['address']['billing']['state'] ?? '',
                'postal_code'    => $form['address']['billing']['zipcode'] ?? '',
                'country_code'   => 'IN',
                'telephone1'     => $form['address']['billing']['telephone'] ?? null,
                'telephone2'     => $form['address']['billing']['alt_telephone'] ?? null,
                'telephone3'     => $form['address']['billing']['fax'] ?? null,
                'telephone4'     => $form['address']['billing']['mobile_phone'] ?? null,
                'email'          => $form['address']['billing']['email'] ?? null,
                'website'        => $form['address']['billing']['website'] ?? null,
                'gst_in_number'  => $form['address']['billing']['gstin_number'] ?? '',
                'arn_number'     => $form['address']['billing']['arn_number'] ?? '',
                'uin_number'     => $form['address']['billing']['uin_number'] ?? '',
                'notes'          => $form['address']['billing']['notes'] ?? null,

                'family_contact_no' => '',
                'family_alt_no'     => '',
                'family_address'    => '',
                'family_member'     => '',
                'father_name'       => '',
                'mother_name'       => '',
            ],

            // Shipping Address - cs
            [
                'ref_id'         => $contactId,
                'type'           => 'cs',
                'primary_name'   => !empty($form['address']['shipping']['company_name'])
                                    ? $form['address']['shipping']['company_name']
                                    : (!empty($form['address']['company_name'])
                                        ? $form['address']['company_name']
                                        : trim(($form['contact']['first_name'] ?? '') . ' ' . ($form['contact']['last_name'] ?? ''))),
                'contact'        => $form['address']['shipping']['attention'] ?? '',
                'address1'       => $form['address']['shipping']['address1'] ?? '',
                'address2'       => $form['address']['shipping']['address2'] ?? '',
                'city_town'      => $form['address']['shipping']['city'] ?? '',
                'region_id'      => !empty($form['address']['shipping']['region_id']) ? (int)$form['address']['shipping']['region_id'] : 0,
                'state_province' => $form['address']['shipping']['state'] ?? '',
                'postal_code'    => $form['address']['shipping']['zipcode'] ?? '',
                'country_code'   => 'IN',
                'telephone1'     => $form['address']['shipping']['telephone'] ?? null,
                'telephone2'     => $form['address']['shipping']['alt_telephone'] ?? null,
                'telephone3'     => $form['address']['shipping']['fax'] ?? null,
                'telephone4'     => $form['address']['shipping']['mobile_phone'] ?? null,
                'email'          => $form['address']['shipping']['email'] ?? null,
                'website'        => $form['address']['shipping']['website'] ?? null,
                'gst_in_number'  => $form['address']['shipping']['gstin_number'] ?? '',
                'arn_number'     => $form['address']['shipping']['arn_number'] ?? '',
                'uin_number'     => $form['address']['shipping']['uin_number'] ?? '',
                'notes'          => $form['address']['shipping']['notes'] ?? null,

                'family_contact_no' => '',
                'family_alt_no'     => '',
                'family_address'    => '',
                'family_member'     => '',
                'father_name'       => '',
                'mother_name'       => '',
            ],
        ];


        DB::table('address_book')->insert($addresses);

        DB::commit();

        return response()->json([
            'success'    => true,
            'message'    => 'Customer saved successfully!',
            'contact_id' => $contactId
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Customer Save Error: ' . $e->getMessage(), ['exception' => $e]);

        return response()->json([
            'success' => false,
            'message' => 'Save failed: ' . $e->getMessage()
        ], 500);
    }
}
}
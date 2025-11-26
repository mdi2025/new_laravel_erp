<?php
// app/Models/Contact.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'type',
        'short_name',
        'inactive',
        'contact_first',
        'contact_middle',
        'contact_last',
        'store_id',
        'gl_type_account',
        'gov_id_number',
        'dept_rep_id',
        'account_number',
        'special_terms',
        'price_sheet',
        'tax_id',
        'attachments',
        'first_date',
        'last_update',
        'last_date_1',
        'last_date_2',
        'mdi_cust_ecc',
        'mdi_cus_tinno',
        'mdi_cus_sezno',
        'mdi_cus_ins_courier',
        'mdi_cus_ins_dispatcher',
        'mdi_cus_ins_production',
        'mdi_cus_rate_contract',
        'mdi_cus_mode_dispatch',
        'mdi_cus_courier_name',
        'mdi_cus_delivery_charges',
        'mdi_cus_excise_applicable',
        'mdi_cus_discount_given',
        'mdi_cus_sales_tax_form',
        'mdi_cus_full_sales_tax',
        'mdi_cus_file_number',
        'mdi_ed_exemption_certificate',
        'mdi_excise_range',
        'mdi_document_sent_thru',
        'material_id',
        'is_export',
        'category_id',
        'cid_crm',
        'currency_code',
        'special_terms_desc',
        'gst_in_no',
        'arn_no',
        'sez_applicable',
        'occupation',
        'gender',
        'residence_distance',
        'gen_category',
        'conveyance_mode',
        'marital_status',
        'job_title',
        'employment_status',
        'supervisor',
        'aadhar_num',
        'pan_no',
        'document',
        'document_name',
        'birth_date',
        'accnt_holder_name',
        'accnt_number',
        'branch_name',
        'bank_name',
        'ifsc_code',
        'shift_time_id',
        'valid_upto',
        'lic_number',
        'esi_number',
        'pf_number',
        'uan_number',
        'ppf_accnt',
        'oab',
        'welfare_deduction',
        'oad',
        'account_head',
        'service_duration',
        'break_time',
        'emp_code',
        'punching_id',
        'joining_date',
        'bond_duration',
        'dept_name',
        'adjustment_calculation',
        'dept_id',
        'esi_applicable',
        'pf_applicable',
        'imported',
        'payment_mode',
        'bonus_applicable',
        'late_coming_start_time',
        'customer_group',
        'late_coming_calculation',
        'attendance_calculation',
        'is_sales_rep',
        'tcs_applicable',
        'ack_applicable',
        'vendor_type',
        'material',
        'vendor_status',
        'dd_applicable',
        'material_type',
        'tds_applicable',
        'mdi_tan',
        'mdi_ice',
        'mdi_msme',
        'mdi_cin',
        'mdi_prn',
        'mdi_group_id',
        'beneficiary',
        'mdi_old_company_name',
        'mdi_bank_acc_no',
        'mdi_ifsc_code',
        'vendor_tds_category',
        'tds_section_name',
    ];

    protected $casts = [
        'inactive'              => 'boolean',
        'is_export'             => 'boolean',
        'sez_applicable'        => 'boolean',
        'tcs_applicable'        => 'boolean',
        'ack_applicable'        => 'boolean',
        'dd_applicable'         => 'boolean',
        'tds_applicable'        => 'boolean',
        'imported'              => 'boolean',
        'is_sales_rep'          => 'boolean',
        'late_coming_start_time'=> 'integer',
        'customer_group'        => 'integer',
        'dept_id'               => 'integer',
        'material_id'           => 'integer',
        'category_id'           => 'integer',
        'service_duration'      => 'float',
        'birth_date'            => 'date:Y-m-d',
        'joining_date'          => 'date:Y-m-d',
        'first_date'            => 'date:Y-m-d',
        'last_update'           => 'date:Y-m-d',
    ];

    // Scopes
    public function scopeCustomers($query)
    {
        return $query->where('type', 'c');
    }

    public function scopeVendors($query)
    {
        return $query->where('type', 'v');
    }

    public function scopeActive($query)
    {
        return $query->where('inactive', '0');
    }

    public function scopeInactive($query)
    {
        return $query->where('inactive', '1');
    }
}
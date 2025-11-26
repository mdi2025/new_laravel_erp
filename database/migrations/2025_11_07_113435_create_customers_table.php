<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

    
return new class extends Migration {
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->unique();          // CUST001
            $table->string('file_number')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('pan_number')->nullable();
            $table->string('ecc_number')->nullable();
            $table->string('sez_number')->nullable();
            $table->boolean('sez_applicable')->default(false);
            $table->boolean('tcs_applicable')->default(false);
            $table->boolean('tds_applicable')->default(false);
            $table->boolean('delivery_date_applicable')->default(false);
            $table->boolean('inactive')->default(false);
            $table->string('currency', 3)->default('INR');
            $table->string('sales_rep_id')->nullable();
            $table->string('category')->nullable();
            $table->string('account_number')->nullable();
            $table->string('default_price_sheet')->nullable();
            $table->string('default_sales_tax')->nullable();
            $table->string('tin_number')->nullable();
            $table->string('payment_terms')->nullable();
            $table->string('export_special_terms')->nullable();
            $table->string('order_acknowledgement')->nullable();

            // ---- Contacts (same as main mailing address) ----
            $table->string('title')->nullable();
            $table->string('contact_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('twitter_id')->nullable();
            $table->string('company_name');
            $table->string('attention')->nullable();
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('region')->nullable();
            $table->string('country');
            $table->string('state');
            $table->string('gstin_number')->nullable();
            $table->string('arn_number')->nullable();
            $table->string('uin_number')->nullable();
            $table->string('telephone')->nullable();
            $table->string('alt_telephone')->nullable();
            $table->string('fax')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('email');
            $table->string('website')->nullable();
            $table->string('zipcode')->nullable();

            // ---- Instructions ----
            $table->text('instruction_courier')->nullable();
            $table->text('instruction_dispatcher')->nullable();
            $table->text('instruction_production')->nullable();

            // ---- Other Information ----
            $table->string('rate_contract')->nullable();
            $table->string('mode_of_dispatch')->nullable();
            $table->string('courier_name')->nullable();
            $table->decimal('delivery_charges', 10, 2)->nullable();
            $table->boolean('excise_duty_applicable')->default(false);
            $table->string('discount_given')->nullable();   // e.g. "5%"
            $table->string('sales_tax_form')->nullable();
            $table->string('full_sales_tax')->nullable();

            // ---- Attachments (JSON) ----
            $table->json('attachments')->nullable();   // [{name,url}, …]

            // ---- More Information ----
            $table->string('tan')->nullable();
            $table->string('iec')->nullable();
            $table->string('provisional_receipt_number')->nullable();
            $table->string('old_company_name')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->string('msme')->nullable();
            $table->string('cin')->nullable();
            $table->string('group_id')->nullable();
            $table->string('ifsc_code')->nullable();

            // ---- Shipping & Billing (JSON) ----
            $table->json('shipping_address')->nullable();
            $table->json('billing_address')->nullable();

            // ---- Notes (JSON) ----
            $table->json('notes')->nullable();   // [{id, sales_rep, date, action, notes}, …]

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
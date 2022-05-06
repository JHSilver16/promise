<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Database extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       // Schema::create('master_accounts', function (Blueprint $table) {
       //      $table->increments('id');
       //      $table->string('name');
       //      $table->timestamps();
       //  });

       // Schema::create('suppliers', function (Blueprint $table) {
       //      $table->increments('id');
       //      $table->string('name');
       //      $table->string('address');
       //      $table->string('contact');
       //      $table->string('tin');
       //      $table->timestamps();
       //  });

       // Schema::create('items', function (Blueprint $table) {
       //      $table->increments('id');
       //      $table->string('name');
       //      $table->integer('danger_level');
       //      $table->decimal('unit_cost', 10, 2);
       //      $table->timestamps();
       //  });

       // Schema::create('inventories', function (Blueprint $table) {
       //      $table->increments('id');
       //      $table->integer('item_id');
       //      $table->date('date');
       //      $table->integer('master_id');
       //      $table->integer('qty_instock');
       //      $table->timestamps();
       //  });

       // Schema::create('inventory_operations', function (Blueprint $table) {
       //      $table->increments('id');
       //      $table->integer('inventory_id');
       //      $table->string('operation');
       //      $table->string('reason');
       //      $table->decimal('danger_level');
       //      $table->integer('qty');
       //      $table->datetime('date');
       //      $table->integer('pr_id');
       //      $table->integer('iac_id');
       //      $table->integer('ris_id');
       //      $table->decimal('unit_cost', 10, 2);
       //      $table->timestamps();
       //  });

       // Schema::create('purchase_requests', function (Blueprint $table) {
       //      $table->increments('id');
       //      $table->string('entity');
       //      $table->string('fund_cluster');
       //      $table->string('ref_no')->unique();
       //      $table->date('date');
       //      $table->string('purpose');
       //      $table->boolean('within_ppmp');
       //      $table->string('requested_by');
       //      $table->string('certified_by');
       //      $table->integer('division_id');
       //      $table->string('approved_by');
       //      $table->timestamps();
       //  });

       // Schema::create('pr_lines', function (Blueprint $table) {
       //      $table->increments('id');
       //      $table->integer('pr_id');
       //      $table->integer('item_id');
       //      $table->integer('qty');
       //      $table->decimal('unit_cost');
       //      $table->decimal('total_cost');
       //      $table->timestamps();
       //  });

       // Schema::create('rfqs', function (Blueprint $table) {
       //      $table->increments('id');
       //      $table->string('philgeps_no');
       //      $table->string('ref_no')->unique();
       //      $table->date('date');
       //      $table->string('amount_words');
       //      $table->integer('pr_id');
       //      $table->integer('supplier_id');
       //      $table->integer('user_id-');
       //      $table->timestamps();
       //  });

       // Schema::create('rfq_lines', function (Blueprint $table) {
       //      $table->increments('id');
       //      $table->integer('prline_id');
       //      $table->string('status');
       //      $table->decimal('qty');
       //      $table->decimal('unit_price');
       //      $table->decimal('total_price');
       //      $table->timestamps();
       //  });

       // Schema::create('abstracts', function (Blueprint $table) {
       //      $table->increments('id');
       //      $table->integer('rfq_id');
       //      $table->string('ref_no')->unique();
       //      $table->date('date');
       //      $table->string('amount_words');
       //      $table->string('pr_no');
       //      $table->string('chair');
       //      $table->integer('buyer');
       //      $table->string('members');
       //      $table->timestamps();
       //  });

       // Schema::create('purchase_orders', function (Blueprint $table) {
       //      $table->increments('id');
       //      $table->integer('rfq_id');
       //      $table->string('ref_no')->unique();
       //      $table->date('date');
       //      $table->string('amount_words');
       //      $table->string('fund_cluster');
       //      $table->string('pr_no');
       //      $table->integer('certified_funds');
       //      $table->decimal('amount', 10, 2);
       //      $table->timestamps();
       //  });

       // Schema::create('acceptances', function (Blueprint $table) {
       //      $table->increments('id');
       //      $table->integer('po_id');
       //      $table->integer('rfq_id');
       //      $table->string('ref_no')->unique();
       //      $table->date('date');
       //      $table->string('invoice_no');
       //      $table->date('invoice_date');
       //      $table->string('fund_cluster');
       //      $table->string('pr_no');
       //      $table->integer('division_id');
       //      $table->date('date_inspected');
       //      $table->string('inspected_by');
       //      $table->boolean('inspected');
       //      $table->date('date_received');
       //      $table->string('received_by');
       //      $table->boolean('complete');
       //      $table->decimal('amount', 10, 2);
       //      $table->timestamps();
       //  });

       // Schema::create('ris', function (Blueprint $table) {
       //      $table->increments('id');
       //      $table->integer('employee_id');
       //      $table->string('fund_cluster');
       //      $table->string('ref_no')->unique();
       //      $table->date('date');
       //      $table->integer('division_id');
       //      $table->date('date_approved');
       //      $table->integer('approved_by');
       //      $table->date('date_issued');
       //      $table->integer('issued_by');
       //      $table->date('date_requested');
       //      $table->integer('requested_by');
       //      $table->date('date_received');
       //      $table->integer('received_by');
       //      $table->timestamps();
       //  });

       // Schema::create('ris_lines', function (Blueprint $table) {
       //      $table->increments('id');
       //      $table->integer('ris_id');
       //      $table->integer('item_id');
       //      $table->integer('req_qty');
       //      $table->boolean('available');
       //      $table->integer('issued_qty');
       //      $table->string('remarks');
       //      $table->timestamps();
       //  });

       //DB::statement("ALTER items set AUTO_INCREMENT = 1001;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

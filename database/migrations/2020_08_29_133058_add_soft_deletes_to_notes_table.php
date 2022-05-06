<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletesToNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pr_lines', function (Blueprint $table) {
            $table->softDeletes();  //add this line
            //
        });

        Schema::table('po_lines', function (Blueprint $table) {
            $table->softDeletes();  //add this line
            //
        });

        Schema::table('ris_lines', function (Blueprint $table) {
            $table->softDeletes();  //add this line
            //
        });

        Schema::table('rfq_lines', function (Blueprint $table) {
            $table->softDeletes();  //add this line
            //
        });
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

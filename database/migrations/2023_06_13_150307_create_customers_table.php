<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string("first_name");
            $table->string("last_name");
            $table->string("street");
            $table->string("city");
            $table->string("state");
            $table->string("zipcode");
            $table->string("phone");
            $table->string("email");
            $table->integer("sales_partner_id");
            $table->date("sold_date");
            $table->string("panel_qty");
            $table->integer("inverter_type_id");
            $table->integer("module_type_id");
            $table->integer("battery_type_id");
            $table->integer("inverter_qty");
            $table->integer("module_qty");
            $table->integer("battery_qty");
            $table->longText("notes")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

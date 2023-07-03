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
        Schema::create('customer_adders', function (Blueprint $table) {
            $table->id();
            $table->integer("customer_id");
            $table->integer("adder_type_id");
            $table->integer("adder_sub_type_id");
            $table->integer("adder_unit_id");
            $table->float("amount");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_adders');
    }
};

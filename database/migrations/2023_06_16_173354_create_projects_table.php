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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer("customer_id");
            $table->integer("department_id")->nullable();
            $table->integer("sub_department_id")->nullable();
            $table->string("project_name");
            $table->date("start_date")->nullable();
            $table->date("end_date")->nullable();
            $table->date("completion_date")->nullable();
            $table->float("budget")->nullable();
            $table->longText("description")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

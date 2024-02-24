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
        Schema::disableForeignKeyConstraints();

        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->string('link', 400)->nullable();
            $table->dateTime('date_applied')->nullable();
            $table->string('salary_annual_min')->nullable();
            $table->string('salary_annual_max')->nullable();
            $table->string('salary_currency', 3)->nullable();
            $table->foreignId('job_application_company_id')->nullable()->constrained();
            $table->foreignId('job_application_role_id')->nullable()->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};

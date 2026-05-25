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
        Schema::create('mechanic_requests', function (Blueprint $table) {

    $table->id();

    $table->foreignId('user_id')->constrained()->onDelete('cascade');

    $table->foreignId('mechanic_id')->constrained()->onDelete('cascade');

    $table->string('customer_name');

    $table->string('phone');

    $table->string('vehicle');

    $table->string('vin');

    $table->text('problem_description');

    $table->date('appointment_date');

    $table->string('appointment_time');

    $table->string('address');

    $table->string('service_type');

    $table->string('status')->default('Pendiente');

    $table->timestamps();

});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mechanic_requests');
    }
};

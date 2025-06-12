<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ussd_requests', function (Blueprint $table) {
            $table->id();
            $table->string('device_id')->nullable();
            $table->string('customer')->nullable();
            $table->string('phone')->nullable();
            $table->string('type_transaction')->nullable();
            $table->string('ussd_code');
            $table->float('amount',2)->nullable(false);
            $table->enum('status', ['pending', 'sent', 'executed'])->default('pending');
             $table->integer('sim_position')->default(1); // 0 = SIM1, 1 = SIM2, etc.
            $table->text('response')->nullable();
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('sim_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('ussd_requests');
    }
};

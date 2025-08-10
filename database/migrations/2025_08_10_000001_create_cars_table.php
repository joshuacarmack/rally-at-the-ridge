<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();

            // Person / contact
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('address', 100)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 20)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('email', 120)->nullable();

            // Vehicle
            $table->enum('vehicle_type', ['car','truck','motorcycle','other'])->nullable();
            $table->unsignedSmallInteger('year')->nullable();
            $table->string('make', 40)->nullable();
            $table->string('model', 40)->nullable();
            $table->string('color', 40)->nullable();

            // Event flags
            $table->boolean('previously_attended')->default(false);
            $table->enum('tshirt_size', ['S','M','L','XL','2XL','3XL'])->nullable();
            $table->string('home_church', 80)->nullable();

            $table->boolean('checked_in')->default(false);
            $table->timestamp('checked_in_at')->nullable();
            $table->foreignId('checked_in_by')->nullable()->constrained('users')->nullOnDelete();

            $table->boolean('tshirt_given')->default(false);
            $table->text('comments')->nullable();
            $table->unsignedSmallInteger('party_size')->default(0);

            $table->boolean('is_last_year_winner')->default(false);
            $table->boolean('is_test')->default(false);

            $table->boolean('prize_drawn')->default(false);
            $table->boolean('prize_claimed')->default(false);

            $table->uuid('submission_token')->nullable()->unique();

            $table->timestamps();

            $table->index(['last_name','first_name']);
            $table->fullText(['first_name','last_name']); // MySQL 8+ InnoDB
        });
    }
    public function down(): void { Schema::dropIfExists('cars'); }
};

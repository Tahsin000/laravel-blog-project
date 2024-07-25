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
        //
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->string('contact_name')->nullable();
            $table->string('contact_mobile');
            $table->string('contact_email');
            $table->string('contact_msg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

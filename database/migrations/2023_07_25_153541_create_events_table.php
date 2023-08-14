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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->longtext('description');
            $table->string('photo');
            $table->string('location');
            $table->foreignId('cat_id')->constrained('categories');
            // $table->string('organize_by'); //by email which is enquie for everyone tara ahile Org Name le garexa
            $table->foreignId('organize_by')->constrained('organizations');
            $table->dateTime('start'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

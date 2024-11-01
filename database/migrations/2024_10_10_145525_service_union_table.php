<?php

use App\Models\Union;
use App\Models\Service;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('service_union', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignIdFor(Service::class, 'service_id')->constrained()->cascadeOnDelete();
        //     $table->foreignId('union_id')->references('id')->on('unions')->onDelete('cascade');
        //     $table->timestamps();
        // });

        Schema::create('service_union', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete(); // Assuming 'services' table exists
            $table->foreignId('union_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_thana');
    }
};

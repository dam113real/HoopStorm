<?php

use App\Models\User;
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
        Schema::create('atlethes', function (Blueprint $table) {
            $table->id(); // Esto crea una columna id con tipo de dato unsignedBigInteger
            $table->string('title', 200);
            $table->string('slug',400);
            $table->longText('description')->nullable();
            $table->longText('extrainfo')->nullable();
            $table->boolean('published')->default(0);

            $table->foreignIdFor(User::class, 'created_by')->nullable();
            $table->foreignIdFor(User::class, 'updated_by')->nullable();

            $table->softDeletes();
            $table->foreignIdFor(User::class, 'deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atlethes');
    }
};



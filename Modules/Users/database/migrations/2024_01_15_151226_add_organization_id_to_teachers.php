<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->foreignId('organization_id')
                ->nullable()
                ->constrained('organizations')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('organization_id');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('badges', function (Blueprint $table) {
            if (! Schema::hasColumn('badges', 'type')) {
                $table->string('type')->after('image_path');
            }
            if (! Schema::hasColumn('badges', 'criteria')) {
                $table->json('criteria')->nullable()->after('type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('badges', function (Blueprint $table) {
            $table->dropColumn(['type', 'criteria']);
        });
    }
};

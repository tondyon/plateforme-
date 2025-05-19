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
        Schema::table('password_reset_tokens', function (Blueprint $table) {
            if (! Schema::hasColumn('password_reset_tokens', 'email')) {
                $table->string('email')->index()->after('id');
            }
            if (! Schema::hasColumn('password_reset_tokens', 'token')) {
                $table->string('token')->after('email');
            }
            if (! Schema::hasColumn('password_reset_tokens', 'created_at')) {
                $table->timestamp('created_at')->nullable()->change();
            }
            if (! Schema::hasColumn('password_reset_tokens', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('password_reset_tokens', function (Blueprint $table) {
            $table->dropColumn(['email', 'token']);
        });
    }
};

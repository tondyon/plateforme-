<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /** Run the migrations. */
    public function up(): void
    {
        DB::table('users')
            ->where('email', 'etudiant@plateforme.test')
            ->update([
                'email' => 'honoretonde21@gmail.com',
                'email_verified_at' => now(),
            ]);
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        DB::table('users')
            ->where('email', 'honoretonde21@gmail.com')
            ->update([
                'email' => null,
                'email_verified_at' => null,
            ]);
    }
};

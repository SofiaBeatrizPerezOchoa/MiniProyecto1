<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('username')->nullable()->after('name')->unique();
            });
        }

        if (! Schema::hasColumn('users', 'activo')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('activo')->default(true)->after('password');
            });
        }

        $this->backfillUsernames();

        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable(false)->change();
            $table->string('email')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['username']);
            $table->dropColumn(['username', 'activo']);
        });

        if (! DB::table('users')->whereNull('email')->exists()) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('email')->nullable(false)->change();
            });
        }
    }

    /**
     * Generate a unique username for every existing user.
     */
    private function backfillUsernames(): void
    {
        $used = [];

        DB::table('users')
            ->select(['id', 'name', 'email'])
            ->orderBy('id')
            ->each(function (object $user) use (&$used): void {
                $source = $user->email ? Str::before((string) $user->email, '@') : (string) $user->name;
                $base = Str::slug($source);
                $base = $base !== '' ? $base : 'usuario'.$user->id;

                $username = $base;
                $suffix = 1;

                while (isset($used[$username]) || DB::table('users')->where('username', $username)->where('id', '!=', $user->id)->exists()) {
                    $username = $base.$suffix;
                    $suffix++;
                }

                $used[$username] = true;

                DB::table('users')->where('id', $user->id)->update(['username' => $username]);
            });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('gender')->nullable()->after('phone');
            $table->date('birth_date')->nullable()->after('gender');
            $table->boolean('email_notifications')->default(true)->after('birth_date');
            $table->boolean('due_reminders')->default(true)->after('email_notifications');
            $table->boolean('weekly_summary')->default(false)->after('due_reminders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'gender',
                'birth_date',
                'email_notifications',
                'due_reminders',
                'weekly_summary'
            ]);
        });
    }
};

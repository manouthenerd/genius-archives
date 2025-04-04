<?php

use App\Models\Member;
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
        Schema::create('member_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Member::class);
            $table->string('ip_address');
            $table->dateTime('login_at');
            $table->dateTime('logout_at')->nullable();
            $table->enum('status', ['online', 'offline'])->default('offline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_sessions');
    }
};

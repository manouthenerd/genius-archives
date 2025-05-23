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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('role')->default('membre');
            $table->string('disk_space');
            $table->string('password');
            $table->string('two_factor_code')->default(rand(1000, 9999));
            $table->timestamp('two_factor_expires_at')->default(now()->addMinutes(15));
            $table->enum('status', ['enable', 'disable'])->default('enable');
            $table->timestamp('email_verified_at')->nullable()->default(NULL);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};

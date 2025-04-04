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
        Schema::create('member_folders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Member::class);
            $table->string('name');
            $table->string('access_level');
            $table->string('visibility');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_folders');
    }
};

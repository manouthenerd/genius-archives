<?php

use App\Models\Folder;
use App\Models\MemberFolder;
use App\Models\UserFolder;
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
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserFolder::class)->nullable();
            $table->foreignIdFor(MemberFolder::class)->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('extension');
            $table->string('file_type');
            $table->string('file_path');
            $table->decimal('file_size', 16, 13);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};

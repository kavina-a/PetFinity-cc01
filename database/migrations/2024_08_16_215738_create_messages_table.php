<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('sender_id');
            $table->string('sender_type'); // 'App\Models\PetOwner', 'App\Models\PetBoardingCenter', 'App\Models\PetTrainingCenter'
            $table->unsignedBigInteger('receiver_id');
            $table->string('receiver_type'); // 'App\Models\PetOwner', 'App\Models\PetBoardingCenter', 'App\Models\PetTrainingCenter'
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};

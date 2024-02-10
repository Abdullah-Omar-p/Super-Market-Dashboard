<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogTable extends Migration
{
    public function up()
    {
        Schema::create('activity_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('log_name')->nullable();
            $table->text('description')->nullable();
            $table->text('subject_type')->nullable();
            $table->unsignedInteger('subject_id')->nullable();
            $table->unsignedInteger('causer_id')->nullable();
            $table->string('causer_type')->nullable();
            $table->json('properties')->nullable();
            $table->string('event')->nullable();
            $table->uuid('batch_uuid')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->unsignedInteger('user_id')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity_log');
    }
}

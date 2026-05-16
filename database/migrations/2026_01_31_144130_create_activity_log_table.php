<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Smpita\ConfigAs\ConfigAs;

class CreateActivityLogTable extends Migration
{
    public function up(): void
    {
        $connection = ConfigAs::nullableString('activitylog.database_connection');
        $tableName = ConfigAs::string('activitylog.table_name');

        Schema::connection($connection)->create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('log_name')->nullable()->index();
            $table->text('description');
            $table->nullableMorphs('subject', 'subject');
            $table->string('event')->nullable();
            $table->nullableMorphs('causer', 'causer');
            $table->json('attribute_changes')->nullable();
            $table->json('properties')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $connection = ConfigAs::string('activitylog.database_connection');
        $tableName = ConfigAs::string('activitylog.table_name');

        Schema::connection($connection)->dropIfExists($tableName);
    }
}

<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    const TABLE_NAME = 'cities';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')
                ->index()
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('name')
                ->comment('City name');
            $table->string('abbreviation')
                ->comment('City abbreviation');
            $table->string('code')
                ->index()
                ->comment('Code');
            $table->string('city_id')
                ->index()
                ->comment('City identification number');
            $table->string('region_code')
                ->comment('Region code');
            $table->text('region_name')
                ->comment('Region name');
            $table->string('min_index')
                ->nullable()
                ->comment('Min index');
            $table->string('max_index')
                ->nullable()
                ->comment('Max index');
        });

        DB::statement(
            "CREATE INDEX name_fts_index ON " . self::TABLE_NAME . "
             USING gin(to_tsvector('russian', name))"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
};

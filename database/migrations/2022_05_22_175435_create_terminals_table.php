<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    const TABLE_NAME = 'terminals';

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
            $table->foreignId('city_id')
                ->index()
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('code')
                ->comment('Terminal code');
            $table->string('name')
                ->comment('Terminal name');
            $table->string('region_code')
                ->comment('Region code');
            $table->string('index')
                ->comment('Address Index');
            $table->text('region_name')
                ->comment('Region name');
            $table->string('city_code')
                ->comment('City code');
            $table->string('city_name')
                ->comment('City name');
            $table->string('street')
                ->nullable()
                ->comment('Street');
            $table->string('street_abbreviation')
                ->nullable()
                ->comment('Street Abbreviation');
            $table->string('house')
                ->nullable()
                ->comment('House');
            $table->string('structure')
                ->nullable()
                ->comment('Structure');
            $table->string('ownership')
                ->nullable()
                ->comment('Ownership');
            $table->text('description')
                ->nullable()
                ->comment('Description');
            $table->float('latitude')
                ->comment('Latitude coordinates');
            $table->float('longitude')
                ->comment('Longitude coordinates');
        });
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

<?php

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
        Schema::table('users', function (Blueprint $table) {
            $table->mediumText('about')->nullable()->after('role');
            $table->mediumText('qualifications')->nullable()->after('about'); 
            $table->text('experience')->nullable()->after('qualifications'); 
            $table->mediumText('portfolio')->nullable()->after('experience'); 
            $table->date('date_of_birth')->nullable()->after('portfolio');
            $table->string('address')->nullable()->after('date_of_birth'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(
                'about',
                'qualifications',
                'experience',
                'portfolio',
                'date_of_birth',
                'address',
            );
        });
    }
};

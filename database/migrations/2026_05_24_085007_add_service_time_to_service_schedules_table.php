<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_schedules', function (Blueprint $table) {
            $table->time('service_time')->nullable()->after('due_date');
            $table->string('vehicle_type')->nullable()->after('service_type'); // mobil/motor/truk/dll
            $table->text('notes')->nullable()->after('status');
        });
    }
 
    public function down(): void
    {
        Schema::table('service_schedules', function (Blueprint $table) {
            $table->dropColumn(['service_time', 'vehicle_type', 'notes']);
        });
    }
};
 
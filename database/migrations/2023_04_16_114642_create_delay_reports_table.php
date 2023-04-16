<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Brokenice\LaravelMysqlPartition\Schema\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('delay_reports', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->unsignedBigInteger('order_id')->index();
            $table->unsignedBigInteger('agent_user_id')->nullable()->index();
            $table->unsignedBigInteger('user_id')->comment('for future reporting');
            $table->unsignedBigInteger('carrier_user_id')->comment('for future reporting');
            $table->unsignedTinyInteger('extend_time')->nullable()->comment('in minute');
            $table->unsignedTinyInteger('state');
            $table->dateTime('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->primary(['id','created_at']);
        });

        # Force autoincrement of one field in composite primary key `id`
        Schema::forceAutoIncrement('delay_reports', 'id');

        app(\Illuminate\Contracts\Console\Kernel::class)->call("partition:delay_reports");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delay_reports');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
        {
            Schema::create('audits', function (Blueprint $table) {
                // Primary key
                $table->id();

                // Polymorphic relation fields
                $table->string('auditable_type');
                $table->string('auditable_id');

                // Audit metadata
                $table->string('event'); // 'created', 'updated', 'deleted'

                // Changed data
                $table->json('old_values')->nullable();
                $table->json('new_values')->nullable();

                // Timestamps
                $table->timestamp('created_at')->useCurrent();

                // Regular indexes
                $table->index(['auditable_type', 'auditable_id'], 'audits_auditable_index');
                $table->index('event');
                $table->index('created_at'); // could be improved by using a partial index like YYYY-MM
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('audits');
        }
};

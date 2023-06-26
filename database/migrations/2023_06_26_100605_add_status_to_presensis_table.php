<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::unprepared('
            CREATE EVENT check_absen_event
            ON SCHEDULE EVERY 1 DAY
            STARTS CURRENT_TIMESTAMP + INTERVAL 10 HOUR
            ON COMPLETION PRESERVE
            DO
            BEGIN
                IF HOUR(CURRENT_TIME()) = 10 THEN
                    INSERT INTO presensis (siswa_id, status, created_at)
                    SELECT id, "alpa", NOW()
                    FROM siswas
                    WHERE id NOT IN (
                        SELECT DISTINCT siswa_id
                        FROM presensis
                        WHERE DATE(created_at) = CURDATE()
                    );
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP EVENT IF EXISTS check_absen_event');
    }
};

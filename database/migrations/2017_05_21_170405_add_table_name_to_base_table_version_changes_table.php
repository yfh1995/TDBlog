<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableNameToBaseTableVersionChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('base_table_version_changes', function (Blueprint $table) {
            $table->string('table_name')->after('new_version_code')->comment('发生数据变更的数据表');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('base_table_version_changes', function (Blueprint $table) {
            $table->dropColumn('table_name');
        });
    }
}

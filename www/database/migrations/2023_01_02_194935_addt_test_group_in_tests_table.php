<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('tests', function (Blueprint $table) {
      if (!Schema::hasColumn('tests', 'test_group_id')) {
        $table->tinyInteger("testGroup_id");
      }
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('tests', function (Blueprint $table) {
      $table->dropColumn("test_group_id");
    });
  }
};

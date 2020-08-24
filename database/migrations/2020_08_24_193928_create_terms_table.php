<?php

use Illuminate\Support\Facades\Schema;
use Nowendwell\LaravelTerms\Models\Term;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->longText('terms')->nullable();
            $table->timestamps();
        });

        Term::create([
            'terms' => 'My first terms',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terms');
    }
}

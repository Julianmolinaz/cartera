<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConceptoFactPrecredito extends Model
{
    protected $table = 'fact_precred_conceptos';

    protected $fillable = ['nombre','estado','valor'];
}

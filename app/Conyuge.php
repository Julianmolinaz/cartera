<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Conyuge extends Model
{
	protected $fillable = [
		'nombrey','p_nombrey','s_nombrey','p_apellidoy','s_apellidoy','tipo_docy','num_docy','diry','movily','fijoy'
	];

	public $timestamps = false;

	public function setNombreyAttribute($value){

		$_1 = ucwords(strtolower($this->p_nombrey));
		$_2 = ' '.ucwords(strtolower($this->s_nombrey));
		$_3 = ' '.ucwords(strtolower($this->p_apellidoy));
		$_4 = ' '.ucwords(strtolower($this->s_apellidoy));

		$this->attributes['nombrey'] = trim($_1.$_2.$_3.$_4);

	}

	public function setPnombreyAttribute($value){
		$this->attributes['p_nombrey'] = ucwords(strtolower($value));	
		$this->setNombreyAttribute($value);	
	}

	public function setSnombreyAttribute($value){
		$this->attributes['s_nombrey'] = ucwords(strtolower($value));		
		$this->setNombreyAttribute($value);
	}


	public function setPapellidoyAttribute($value){
		$this->attributes['p_apellidoy'] = ucwords(strtolower($value));		
		$this->setNombreyAttribute($value);
	}


	public function setSapellidoyAttribute($value){
		$this->attributes['s_apellidoy'] = ucwords(strtolower($value));		
		$this->setNombreyAttribute($value);
	}

}

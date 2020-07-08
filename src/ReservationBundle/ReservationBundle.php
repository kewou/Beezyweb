<?php

namespace ReservationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ReservationBundle extends Bundle {
	
	public function boot() {
		parent::boot();
		date_default_timezone_set("Europe/Paris");
	}
}

<?php

namespace App\Repositories;

use App\Models\Wallet;

class WalletRepository
{
	
    public static function updatePayerValue($payer,$value) {
		$w = Wallet::find($payer);
        $w->value -= $value;
        $w->save();
	}

	public static function updatePayeeValue($payee,$value) {
		$w = Wallet::find($payee);
        $w->value += $value;
        $w->save();
	}
    
}
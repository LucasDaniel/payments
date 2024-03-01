<?php

namespace App\Repositories;

use App\Models\Wallet;

class WalletRepository extends BaseRepository
{

    public function __construct() {
		$this->model = new Wallet();
	}
	
    public function updateUserValue(int $id_user,int $value): void {
		$w = $this->model::find($id_user);
        $w->value = $w->value + $value;
        $w->save();
	}
    
}
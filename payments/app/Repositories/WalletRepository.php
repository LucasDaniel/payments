<?php

namespace App\Repositories;

use App\Models\Wallet;

class WalletRepository extends BaseRepository
{
    /**
     * Begin the model
     */
    public function __construct() {
        $this->model = new Wallet();
    }
    
    /**
     * Update the user wallet value by id user
     * @param int, int
     * @return void
     */
    public function updateUserValue(int $id_user,int $value): void {
        $w = $this->model::find($id_user);
        $w->value = $w->value + $value;
        $w->save();
    }
    
}
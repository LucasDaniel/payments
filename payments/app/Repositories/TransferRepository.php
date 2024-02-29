<?php

namespace App\Repositories;

use App\Enums\EnumStateTransfer;
use App\Models\Transfer;

class TransferRepository
{
	
    public static function findWithState($id): Transfer {
        return Transfer::find($id)
                        ->select('transfers.payee','transfers.payer','st.state')
                        ->join('state_transfers as st', 'st.id', '=', 'transfers.id_state')
                        ->get()
                        ->first();
    }

    public static function makeTranfer($transfer): int {
        $t = new Transfer();
        $t->id_state = StateTransferRepository::getIdStateTransfer(EnumStateTransfer::PENDING->value);
        $t->payer = $transfer['payer'];
        $t->payee = $transfer['payee'];
        $t->value = $transfer['value'];
        $t->save();
        return $t->id;
    }

    public static function setTransferFinished(int $id): void {
        $t = Transfer::find($id);
        $t->id_state = StateTransferRepository::getIdStateTransfer(EnumStateTransfer::FINISHED->value);
        $t->update();
    }

    public static function setTransferError(int $id): void {
        $t = Transfer::find($id);
        $t->id_state = StateTransferRepository::getIdStateTransfer(EnumStateTransfer::ERROR->value);
        $t->update();
    }

    public static function setTransferReturned(int $id): void {
        $t = Transfer::find($id);
        $t->id_state = StateTransferRepository::getIdStateTransfer(EnumStateTransfer::RETURNED->value);
        $t->update();
    }
    
}
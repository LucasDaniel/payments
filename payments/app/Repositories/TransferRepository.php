<?php

namespace App\Repositories;

use App\Enums\EnumStateTransfer;
use App\Models\Transfer;
use Illuminate\Database\Eloquent\Collection;

class TransferRepository extends BaseRepository
{
    public function __construct() {
        $this->model = new Transfer();
    }

    public function all(): Collection {
        return $this->model::select('transfers.id','transfers.payee','transfers.payer','transfers.value','st.state')
                        ->join('state_transfers as st', 'st.id', '=', 'transfers.id_state')
                        ->get();
    }

    public function findWithState($id): object|null {
        return $this->model::select('transfers.payee','transfers.payer','transfers.value','st.state')
                        ->join('state_transfers as st', 'st.id', '=', 'transfers.id_state')
                        ->where('transfers.id',$id)
                        ->get()
                        ->first();
    }

    public function makeTranfer(array $transfer): int {
        $StateTransferRepository = new StateTransferRepository();
        $t = new Transfer();
        $t->id_state = $StateTransferRepository->getIdStateTransfer(EnumStateTransfer::PENDING->value);
        $t->payer = $transfer['payer'];
        $t->payee = $transfer['payee'];
        $t->value = $transfer['value'];
        $t->save();
        return $t->id;
    }

    public function setTransferFinished(int $id): void {
        $StateTransferRepository = new StateTransferRepository();
        $t = Transfer::find($id);
        $t->id_state = $StateTransferRepository->getIdStateTransfer(EnumStateTransfer::FINISHED->value);
        $t->update();
    }

    public function setTransferError(int $id): void {
        $StateTransferRepository = new StateTransferRepository();
        $t = Transfer::find($id);
        $t->id_state = $StateTransferRepository->getIdStateTransfer(EnumStateTransfer::ERROR->value);
        $t->update();
    }

    public function setTransferReturned(int $id): void {
        $StateTransferRepository = new StateTransferRepository();
        $t = Transfer::find($id);
        $t->id_state = $StateTransferRepository->getIdStateTransfer(EnumStateTransfer::RETURNED->value);
        $t->update();
    }
    
}
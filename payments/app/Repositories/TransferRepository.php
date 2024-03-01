<?php

namespace App\Repositories;

use App\Enums\EnumStateTransfer;
use App\Models\Transfer;
use Illuminate\Database\Eloquent\Collection;

class TransferRepository extends BaseRepository
{
    /**
     * Begin the model
     */
    public function __construct() {
        $this->model = new Transfer();
    }

    /**
     * Get all datas with, payee, payer, value and string state
     * @return Collection
     */
    public function all(): Collection {
        return $this->model::select('transfers.id','transfers.payee','transfers.payer','transfers.value','st.state')
                        ->join('state_transfers as st', 'st.id', '=', 'transfers.id_state')
                        ->get();
    }

    /**
     * Get data by id with, payee, payer, value and string state
     * @param int
     * @return object or null
     */
    public function findWithState(int $id): object|null {
        return $this->model::select('transfers.payee','transfers.payer','transfers.value','st.state')
                        ->join('state_transfers as st', 'st.id', '=', 'transfers.id_state')
                        ->where('transfers.id',$id)
                        ->get()
                        ->first();
    }

    /**
     * Make the transfer of users with value
     * @param array
     * @return int
     */
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

    /**
     * Set the transfer finished
     * @param int
     * @return void
     */
    public function setTransferFinished(int $id): void {
        $StateTransferRepository = new StateTransferRepository();
        $t = Transfer::find($id);
        $t->id_state = $StateTransferRepository->getIdStateTransfer(EnumStateTransfer::FINISHED->value);
        $t->update();
    }

    /**
     * Set the transfer with error
     * @param int
     * @return void
     */
    public function setTransferError(int $id): void {
        $StateTransferRepository = new StateTransferRepository();
        $t = Transfer::find($id);
        $t->id_state = $StateTransferRepository->getIdStateTransfer(EnumStateTransfer::ERROR->value);
        $t->update();
    }

    /**
     * Set the transfer returned
     * @param int
     * @return void
     */
    public function setTransferReturned(int $id): void {
        $StateTransferRepository = new StateTransferRepository();
        $t = Transfer::find($id);
        $t->id_state = $StateTransferRepository->getIdStateTransfer(EnumStateTransfer::RETURNED->value);
        $t->update();
    }
    
}
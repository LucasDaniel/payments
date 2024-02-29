<?php

namespace Database\Seeders;

use App\Enums\EnumStateTransfer;
use App\Models\Transfer;
use App\Repositories\StateTransferRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransferSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $t = new Transfer();
        $t->id_state = StateTransferRepository::getIdStateTransfer(EnumStateTransfer::RETURNED->value);
        $t->payer = 2;
        $t->payee = 3;
        $t->value = 100;
        $t->save();

        $t = new Transfer();
        $t->id_state = StateTransferRepository::getIdStateTransfer(EnumStateTransfer::PENDING->value);
        $t->payer = 2;
        $t->payee = 3;
        $t->value = 100;
        $t->save();

        $t = new Transfer();
        $t->id_state = StateTransferRepository::getIdStateTransfer(EnumStateTransfer::ERROR->value);
        $t->payer = 2;
        $t->payee = 3;
        $t->value = 100;
        $t->save();

        $t = new Transfer();
        $t->id_state = StateTransferRepository::getIdStateTransfer(EnumStateTransfer::FINISHED->value);
        $t->payer = 2;
        $t->payee = 3;
        $t->value = 100;
        $t->save();

        $t = new Transfer();
        $t->id_state = StateTransferRepository::getIdStateTransfer(EnumStateTransfer::FINISHED->value);
        $t->payer = 2;
        $t->payee = 3;
        $t->value = 100;
        $t->save();

        $t = new Transfer();
        $t->id_state = StateTransferRepository::getIdStateTransfer(EnumStateTransfer::FINISHED->value);
        $t->payer = 2;
        $t->payee = 3;
        $t->value = 100;
        $t->save();
    }
}

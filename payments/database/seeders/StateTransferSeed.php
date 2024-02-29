<?php

namespace Database\Seeders;

use App\Enums\EnumStateTransfer;
use App\Enums\EnumTypeUser;
use App\Models\StateTransfer;
use App\Models\TypeUser;
use App\Utils\Constants;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateTransferSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $st = new StateTransfer();
        $st->state = EnumStateTransfer::PENDING->value;
        $st->save();

        $st = new StateTransfer();
        $st->state = EnumStateTransfer::FINISHED->value;
        $st->save();

        $st = new StateTransfer();
        $st->state = EnumStateTransfer::ERROR->value;
        $st->save();

        $st = new StateTransfer();
        $st->state = EnumStateTransfer::RETURNED->value;
        $st->save();
    }
}

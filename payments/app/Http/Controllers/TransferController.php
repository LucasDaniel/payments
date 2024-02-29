<?php

namespace App\Http\Controllers;

use App\Enums\EnumResponse;
use App\Enums\EnumStateTransfer;
use App\Enums\EnumTypeUser;
use App\Repositories\TransferRepository;
use App\Repositories\UserRepository;
use App\Repositories\WalletRepository;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class TransferController extends Controller
{

    public function transfer(Request $request): string {

        try {
            
            $this->return = false;

            $request->validate([
                'value' => 'required|numeric|min:0.01',
                'payer' => 'required|integer',
                'payee' => 'required|integer'
            ]);

            $value = $request->get('value');
            $payer = $request->get('payer');
            $payee = $request->get('payee');

            $user_payer = UserRepository::findUserTypeWallet($payer);
            if (!$user_payer) $this->exception($this->dictionary['error']['getUserPayer']);

            $user_payee = UserRepository::find($payee);
            if (!$user_payee) $this->exception($this->dictionary['error']['getUserPayee']);
            
            if ($user_payer->type == EnumTypeUser::COMUM->value) {

                if ($user_payer->value >= $value) {

                    $id_transfer = TransferRepository::makeTranfer($request->all());
                    if (!$id_transfer) $this->exception($this->dictionary['error']['getTransfer']);

                    $response = Http::get(env('MOCK_FINISH_TRANSFER'));

                    if ($response->successful() && 
                        $response->object()->message == EnumResponse::AUTORIZED->value) {

                        WalletRepository::updatePayerValue($payer,$value);
                        WalletRepository::updatePayeeValue($payee,$value);
                        TransferRepository::setTransferFinished($id_transfer);

                        $response = Http::get(env('MOCK_RECEIVED_PAYMENT'));

                        if ($response->successful() && $response->object()->message) $this->return = true;
                        else $this->exception($this->dictionary['error']['sendMessage']);

                    } else {

                        TransferRepository::setTransferError($id_transfer);
                        $this->exception($this->dictionary['error']['finishTransfer']);

                    }
                } else $this->exception($this->dictionary['error']['dontHaveMoney']);
            } else $this->exception($this->dictionary['error']['storeNoSendMoney']);

        } catch(Exception $e) {
            $this->return = $e->getMessage()." - ".$e->getCode();
        }

        return $this->return;
    }

    public function returnTransfer(Request $request): string {
        
        try {

            $this->return = false;

            $request->validate([
                'id_transfer' => 'required|integer',
            ]);

            $id_transfer = $request->get('id_transfer');

            $transfer = TransferRepository::findWithState($id_transfer);
            if (!$transfer) $this->exception($this->dictionary['error']['getTransferToReturnValues']);
            
            if ($transfer->state == EnumStateTransfer::FINISHED->value) {

                WalletRepository::updatePayerValue($transfer->payer,-$transfer->value);
                WalletRepository::updatePayeeValue($transfer->payee,-$transfer->value);
                TransferRepository::setTransferReturned($id_transfer);

                $this->return = true;

            } else $this->exception($this->dictionary['error']['transferNotFinishedToReturnValues']);

        } catch(Exception $e) {
            $this->return = $e->getMessage()." - ".$e->getCode();
        }

        return $this->return;
    }
}

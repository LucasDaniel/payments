<?php

namespace App\Http\Controllers;

use App\Enums\EnumResponse;
use App\Enums\EnumStateTransfer;
use App\Enums\EnumTypeUser;
use App\Models\Transfer;
use App\Repositories\TransferRepository;
use App\Repositories\UserRepository;
use App\Repositories\WalletRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class TransferController extends Controller
{

    public function __construct() {
        $this->model = new Transfer();
        $this->repository = new TransferRepository();
    }

    public function transfer(Request $request): string {

        try {
            
            $this->return = false;

            $userRepository = new UserRepository();
            $transferRepository = new TransferRepository();
            $walletRepository = new WalletRepository();

            $request->validate([
                'value' => 'required|numeric|min:0.01',
                'payer' => 'required|integer',
                'payee' => 'required|integer'
            ]);

            $value = $request->get('value');
            $payer = $request->get('payer');
            $payee = $request->get('payee');

            $user_payer = $userRepository->findUserTypeWallet($payer);
            if (!$user_payer) $this->exception($this->dictionary['error']['getUserPayer']);

            $user_payee = $userRepository->find($payee);
            if (!$user_payee) $this->exception($this->dictionary['error']['getUserPayee']);
            
            if ($user_payer->type == EnumTypeUser::COMUM->value) {

                if ($user_payer->value >= $value) {

                    $id_transfer = $transferRepository->makeTranfer($request->all());
                    if (!$id_transfer) $this->exception($this->dictionary['error']['getTransfer']);

                    $response = Http::get(env('MOCK_FINISH_TRANSFER'));

                    if ($response->successful() && 
                        $response->object()->message == EnumResponse::AUTORIZED->value) {

                        $walletRepository->updateUserValue($payer,-$value);
                        $walletRepository->updateUserValue($payee,$value);
                        $transferRepository->setTransferFinished($id_transfer);

                        $response = Http::get(env('MOCK_RECEIVED_PAYMENT'));

                        if ($response->successful() && $response->object()->message) $this->return = true;
                        else $this->exception($this->dictionary['error']['sendMessage']);

                    } else {

                        $transferRepository->setTransferError($id_transfer);
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

            $transferRepository = new TransferRepository();
            $walletRepository = new WalletRepository();

            $request->validate([
                'id_transfer' => 'required|integer',
            ]);

            $id_transfer = $request->get('id_transfer');

            $transfer = $transferRepository->findWithState($id_transfer);
            if (!$transfer) $this->exception($this->dictionary['error']['getTransferToReturnValues']);
            
            if ($transfer->state == EnumStateTransfer::FINISHED->value) {
                
                $walletRepository->updateUserValue($transfer->payer,$transfer->value);
                $walletRepository->updateUserValue($transfer->payee,-$transfer->value);
                $transferRepository->setTransferReturned($id_transfer);

                $this->return = true;

            } else $this->exception($this->dictionary['error']['transferNotFinishedToReturnValues']);

        } catch(Exception $e) {
            $this->return = $e->getMessage()." - ".$e->getCode();
        }

        return $this->return;
    }
}

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
    /**
     * Constructor, set model and repository
     */
    public function __construct() {
        $this->model = new Transfer();
        $this->repository = new TransferRepository();
    }

    /**
     * Do transfer between users
     * No make transfer from store to user/store
     * @param Request
     * @return string
     */
    public function transfer(Request $request): string {

        try {
            
            $this->return = false;

            //Begin the repositories we uses
            $userRepository = new UserRepository();
            $transferRepository = new TransferRepository();
            $walletRepository = new WalletRepository();

            //Validate the value, payee and payer
            $request->validate([
                'value' => 'required|numeric|min:0.01',
                'payer' => 'required|integer',
                'payee' => 'required|integer'
            ]);

            //get the values
            $value = $request->get('value');
            $payer = $request->get('payer');
            $payee = $request->get('payee');

            //verify if exists
            $user_payer = $userRepository->findUserTypeWallet($payer);
            if (!$user_payer) $this->exception($this->dictionary['error']['getUserPayer']);

            //verify if exists
            $user_payee = $userRepository->find($payee);
            if (!$user_payee) $this->exception($this->dictionary['error']['getUserPayee']);
            
            //if payer if comum user, continuos
            if ($user_payer->type == EnumTypeUser::COMUM->value) {

                //if payer have money, continuous
                if ($user_payer->value >= $value) {

                    //Make the transfer
                    $id_transfer = $transferRepository->makeTranfer($request->all());
                    if (!$id_transfer) $this->exception($this->dictionary['error']['getTransfer']);

                    //Make the finish transfer
                    $response = Http::get(env('MOCK_FINISH_TRANSFER'));

                    if ($response->successful() && 
                        $response->object()->message == EnumResponse::AUTORIZED->value) {

                        //Make the Transfer
                        $walletRepository->updateUserValue($payer,-$value);
                        $walletRepository->updateUserValue($payee,$value);
                        $transferRepository->setTransferFinished($id_transfer);

                        //Send the message to users know about the transfer
                        $response = Http::get(env('MOCK_RECEIVED_PAYMENT'));

                        if ($response->successful() && $response->object()->message) $this->return = true;
                        else $this->exception($this->dictionary['error']['sendMessage']);

                    } else {

                        //if transfer have error, set in databse is error
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

            //Begin the repositories we uses
            $transferRepository = new TransferRepository();
            $walletRepository = new WalletRepository();

            //Validate the value, payee and payer
            $request->validate([
                'id_transfer' => 'required|integer',
            ]);

            //get the values
            $id_transfer = $request->get('id_transfer');

            //verify if exists
            $transfer = $transferRepository->findWithState($id_transfer);
            if (!$transfer) $this->exception($this->dictionary['error']['getTransferToReturnValues']);
            
            //if transfer state is finished, continuous
            if ($transfer->state == EnumStateTransfer::FINISHED->value) {
                
                //Return the values to owners, and set transfer to returned
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

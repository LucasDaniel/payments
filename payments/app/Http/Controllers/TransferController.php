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
use App\Models\Transfer;
use Illuminate\Http\Request;

class TransferController extends Controller
{

    public function transfer(Request $request) {

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
            if (!$user_payer) $this->exception("Error on get user payer!",502);

            $user_payee = UserRepository::find($payee);
            if (!$user_payee) $this->exception("Error on get user payee!",510);
            
            if ($user_payer->type == EnumTypeUser::COMUM->value) {

                if ($user_payer->value >= $value) {

                    $id_transfer = TransferRepository::makeTranfer($request->all());
                    if (!$id_transfer) $this->exception("Error on get transfer!",503);

                    $response = Http::get(env('MOCK_FINISH_TRANSFER'));

                    if ($response->successful() && 
                        $response->object()->message == EnumResponse::AUTORIZED->value) {

                        WalletRepository::updatePayerValue($payer,$value);
                        WalletRepository::updatePayeeValue($payee,$value);
                        TransferRepository::setTransferFinished($id_transfer);

                        $response = Http::get(env('MOCK_RECEIVED_PAYMENT'));

                        if ($response->successful() && $response->object()->message) $this->return = true;
                        else $this->exception("Error on send message to payer and payee!",504);

                    } else {

                        TransferRepository::setTransferError($id_transfer);
                        $this->exception("Error on Mocky!",505);

                    }
                } else $this->exception("Don't have money!",506);
            } else $this->exception("STORE don't send money to anyone!",507);

        } catch(Exception $e) {
            $this->return = $e->getMessage()." - ".$e->getCode();
        }

        return $this->return;
    }

    public function returnTransfer(Request $request) {
        
        try {

            $this->return = false;

            $request->validate([
                'id_transfer' => 'required|integer',
            ]);

            $id_transfer = $request->get('id_transfer');

            $transfer = TransferRepository::findWithState($id_transfer);
            if (!$transfer) $this->exception("Error on get transfer to return values!",508);
            
            if ($transfer->state == EnumStateTransfer::FINISHED->value) {

                WalletRepository::updatePayerValue($transfer->payer,-$transfer->value);
                WalletRepository::updatePayeeValue($transfer->payee,-$transfer->value);
                TransferRepository::setTransferReturned($id_transfer);

                $this->return = true;

            } else $this->exception("Tranfer is not finished to return values!",509);

        } catch(Exception $e) {
            $this->return = $e->getMessage()." - ".$e->getCode();
        }

        return $this->return;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transfer $transfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transfer $transfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transfer $transfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transfer $transfer)
    {
        //
    }
}

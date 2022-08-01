<?php

namespace App\Utilities;
use App\Utilities\Paystack;
use Exception;


class Payment 
{
    /**
     * Verify paystack payment
     */
    public function verify($reference = '') 
    {
        if (empty($reference)) {
            return = [
                'status' => 0,
                'info' => 'Invalid payment reference',
            ];
        }

        $deposit = Deposit::where([
            'reference' => $reference,
            'user_id' => auth()->id(),
        ])->first();

        if (empty($deposit)) {
            return = [
                'status' => 0,
                'info' => 'Invalid deposit transaction',
            ];
        }

        if ('paid' === strtolower($deposit->status) && true === (boolean)$deposit->deposited) {
            return = [
                'status' => 1,
                'info' => 'Deposit already verified',
            ];
        }

        $paystack = (new Paystack())->verify($reference);
        if (false === $paystack || !is_object($paystack) || !isset($paystack->data)) {
            return [
                'status' => 0,
                'info' => 'Payment transaction failed.'
            ];
        }

        $deposit->deposited = true;
        $deposit->status = 'active';
        if(!$deposit->update()) {
            return = [
                'status' => 0,
                'info' => '',
            ];
        }

        [$status, $info] = \App\Utilities\Balance::save((int)$deposit->amount);
        if((int)$status === 1) {
            return = [
                'status' => $status,
                'info' => $info,
            ];
        }

        return = [
            'status' => 0,
            'info' => 'Transaction failed. Try again.',
        ];
    }

}
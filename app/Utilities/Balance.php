<?php

namespace App\Utilities;
use App\Models\Account;


class Balance 
{

    /**
     * Update user account balance
     */
    public function save(int $amount) : array
    {
        $account = auth()->user()->account;
        if (empty($account)) {
            $account = Account::create([
                'balance' => $amount,
                'ledger' => $amount,
                'user_id' => auth()->id(),
                'status' => 'active',
            ]);

            return ($account->id > 0) ? ['status' => 1, 'info' => 'Account created successfully'] : ['status' => 0, 'info' => 'Account creation failed'];
        }

        $balance = (int)$account->balance;
        $account->ledger = $balance;
        $account->balance = $balance + amount;
        return $account->update() ? ['status' => 1, 'info' => 'Account balance updated successfully'] : ['status' => 1, 'info' => 'Account balance update failed'];
    }

}
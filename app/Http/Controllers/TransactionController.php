<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->get();
        $sectionText = (new SectionController)->getSectionText('transactions');

       /* foreach ($transactions as $transaction) {
            if (transaction.size == 'medium' || transaction.size == 'large') {
                $transaction->type = 'left_image';
            } elseif ($transaction->how_in_background) {
                $transaction->type = 'bg_image';
            } else {
                $transaction->type = '';
            }

        }*/

        return view('transactions/index',
            [
                'transactions' => $transactions,
                'sectionText'  => $sectionText,
            ]
        );
    }
}

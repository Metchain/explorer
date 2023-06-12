<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\UserWallet;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    //

    function Index(){
        //$msg = $this->GetTransactions();
        $transactions = $this->GetLatestTransactions();
        $blocks = $this->GetLatestBlocks();
        return view("home",['transactions'=>$transactions,'blocks'=>$blocks]);
    }

    function Transactions(Request $request){
        $tx = DB::table('transactions')->join('blocks','blocks.block_height','=','transactions.block_height')->where('txHash','=',$request->tx)->first();
        dd($tx);
        return view('transaction',['tx'=>$tx]);
        
        
    }

    function GetLatestTransactions(){
        return DB::table('transactions')->latest('id')->limit(10)->get();
    }
    function GetLatestBlocks(){
        return DB::table('blocks')->latest('id')->limit(10)->get();
    }

   function GetTransactions(){
        //$blocks = file_get_contents("https://127.0.0.1:5000/block");
        $blocks = DB::table('blocks')->latest('id')->first();
        if(!$blocks){
            $block_id = 1;
        }else{
            $block_id = $blocks->block_height+1;
        }
        $blocks = file_get_contents("http://127.0.0.1:5000/block?height=".$block_id);
        
        $block = json_decode($blocks);
       if($block->timestamp =="0"){
            return "Completely synced";
       }
        // dd($block);
        $data = DB::table('blocks')->insert([
            'block_height' => $block->height,
            'timestamp' => $block->timestamp,
            'nonce' => $block->nonce,
            'megablock' => $block->megablock,
            'metblock' => $block->metblock,
            'previousHash' => $block->previousHash,
            'currentHash' => $block->currentHash,
        ]);
        $blocks = file_get_contents("http://127.0.0.1:5000/blocktx?height=".$block_id);
        $block = json_decode($blocks);
        foreach($block->transaction as $transaction){
            $data = DB::table('transactions')->insert([
                'block_height' => $block->height,
                'from' => $transaction->sender_blockchain_address,
                'to' => $transaction->recipient_blockchain_address,
                'amount' => $transaction->value,
                'txHash' => $transaction->txhash,
                'timestamp' => $transaction->timestamp,
            ]);
    
        }
        
        
   }

    
    
}

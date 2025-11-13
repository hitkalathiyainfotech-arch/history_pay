<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Currency;
use Illuminate\Support\Facades\Http;

class TestCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:currency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Currency Updated';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return 0;

        $btc = Http::get('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin%2C%20dogecoin%2C%20%20shiba%2C%20usdt&vs_currencies=usd%2C%20usd%2C%20usd%2C%20usd')->json();
        $bitcoin = $btc['bitcoin'];
        $coin_value1 = $bitcoin['usd'];

        $doge = Http::get('https://api.coingecko.com/api/v3/simple/price?ids=dogecoin%2C%20%20shiba%2C%20usdt&vs_currencies=usd%2C%20usd%2C%20usd%2C%20usd')->json();
        $dogecoin = $doge['dogecoin'];
        $coin_value2 = $dogecoin['usd'];

        $shibu = Http::get('https://api.coingecko.com/api/v3/simple/price?ids=shiba-inu%2C%20usdt&vs_currencies=usd%2C%20usd%2C%20usd%2C%20usd')->json();
        $shiba = $shibu['shiba-inu'];
        $coin_value3 = $shiba['usd'];

        $currenct1 = Currency::find(1);
        $currenct1->value = $coin_value1;
        $currenct1->save();
        $currenct2 = Currency::find(2);
        $currenct2->value = $coin_value2;
        $currenct2->save();
        $currenct3 = Currency::find(3);
        $currenct3->value = $coin_value3;
        $currenct3->save();

        $this->info('success');
    }
}

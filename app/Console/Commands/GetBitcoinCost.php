<?php

namespace App\Console\Commands;

use App\Models\BitcoinPrice;
use Goutte\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GetBitcoinCost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getbitcoincost
                            {status=200 : The expected status code}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get latest Bitcoin price';

    protected $client;

    /**
     * GetBitcoinCost constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct();

        $this->client = $client;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $url = env('BITCOIN_COST_PARSE_URL');
            $this->client->request('GET', $url);
            $response = $this->client->getResponse();
            $status = $response->getStatus();
            $content = $response->getContent();
            $this->setLatestBitcoinPrice($content);

        } catch (\Exception $e) {
            Log::error("Request failed for $url with an exception");
            Log::error($e->getMessage());
            return 2;
        }

        if ($status !== 200) {
            Log::error("Request failed for $url with a status of '$status'");
            return 1;
        }

        Log::debug("Data received successfully from $url");

        return 0;
    }

    /**
     * @param string $content
     */
    private function setLatestBitcoinPrice(string $content)
    {
        $contentArray = json_decode($content);
        $bitcoinByCurrencies = $contentArray->bpi;
        $bitcoinPriceModel = app(BitcoinPrice::class);

        $bitcoinPricesFields = [
            'updated' => $contentArray->time->updated,
            'usd' => round($bitcoinByCurrencies->USD->rate_float,2),
            'eur' => round($bitcoinByCurrencies->EUR->rate_float,2),
            'gbp' => round($bitcoinByCurrencies->GBP->rate_float,2)
        ];

        $bitcoinPriceModel::updateOrCreate(['updated' => $bitcoinPricesFields['updated']], $bitcoinPricesFields);
    }
}

<?php

namespace App\Http\Controllers;

use App\DataTables\BitcoinPriceTable;

class BitcoinPriceController extends Controller
{
    /**
     * @param BitcoinPriceTable $bitcoinPriceTable
     * @return mixed
     */
    public function index(BitcoinPriceTable $bitcoinPriceTable)
    {
        return $bitcoinPriceTable->render('index');
    }
}
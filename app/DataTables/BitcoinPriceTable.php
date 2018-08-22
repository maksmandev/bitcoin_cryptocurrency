<?php

namespace App\DataTables;

use App\Models\BitcoinPrice;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class BitcoinPriceTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query): DataTableAbstract
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable;
    }


    /**
     * @param BitcoinPrice $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BitcoinPrice $model): \Illuminate\Database\Eloquent\Builder
    {
        return $model->newQuery();

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): Builder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'order' => [
                    0,
                    'desc'
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [

            [
                'title' => 'Id',
                'data' => 'id',
                'width' => '10px'
            ],
            [
                'title' => 'Updated',
                'data' => 'updated',
                'width' => '300px'
            ],
            'usd',
            'eur',
            'gbp'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'bitcoinpricedatatable_' . time();
    }
}
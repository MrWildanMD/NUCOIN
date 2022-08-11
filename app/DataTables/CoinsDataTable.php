<?php

namespace App\DataTables;

use App\Models\Coin;
use App\Models\Coins;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CoinsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('From user', function ($row) {
                return $row->users->name;
            })
            ->addColumn('donator', function ($row) {
                return $row->donators->name;
            })
            ->addColumn('action', function ($row) {
                $action = '';
                if (Gate::allows('update coin')) {
                    $action = '<button type="button" data-id=' . $row->id . ' data-jenis="edit" class="btn btn-sm btn-outline-primary action"><i class="bi bi-pencil"></i></button>';
                }
                if (Gate::allows('delete coin')) {
                    $action .= ' <button type="button" data-id=' . $row->id . ' data-jenis="delete" class="btn btn-sm btn-outline-danger ms-2 action"><i class="bi bi-trash"></i></button>';
                }
                return $action;
            })
            ->addColumn('proof', function ($row) {
                return '<img class="w-100" src=' . url('images/', $row->proof) . '>';
            })
            ->rawColumns(['action', 'proof']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Coin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Coins $model): QueryBuilder
    {
        $model::with('donators');
        $model::with('users');
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('coins-table')
            ->serverSide(true)
            ->language('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json')
            ->responsive(true)
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false),
            Column::computed('proof')->width(150)->addClass('text-center')->searchable(false)->orderable(false),
            Column::make('amount'),
            Column::make('coin_date')->title('Date'),
            Column::make('From user'),
            Column::make('donator'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Coins_' . date('YmdHis');
    }
}

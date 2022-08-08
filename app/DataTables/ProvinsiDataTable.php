<?php

namespace App\DataTables;

use App\Models\Provinsi;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProvinsiDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('kode', function ($prov) {
                return $prov->code;
            })
            ->addColumn('status', function ($prov) {
                return $prov->status == TRUE ? 'ACTIVE' : 'INACTIVE';
            })
            ->addColumn('action', function ($prov) {
                return view('provinsi.action', [
                    'object' => $prov
                ]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Provinsi $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Provinsi $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('provinsi-table')
            ->columns($this->getColumns())
            ->minifiedAjax();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex')->title('#')->width(20)->addClass('text-center'),
            Column::make('kode')->title('Kode'),
            Column::make('name')->title('Nama Provinsi')->addClass('text-center'),
            Column::computed('status')->title('Nama Provinsi')->addClass('text-center'),
            Column::computed('action')->title('Action')->addClass('text-center'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Provinsi_' . date('YmdHis');
    }
}

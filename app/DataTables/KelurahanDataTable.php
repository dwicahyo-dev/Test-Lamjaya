<?php

namespace App\DataTables;

use App\Models\Kelurahan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KelurahanDataTable extends DataTable
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
            ->editColumn('kode', function ($kelu) {
                return $kelu->code;
            })
            ->addColumn('status', function ($kelu) {
                return $kelu->status == TRUE ? 'ACTIVE' : 'INACTIVE';
            })
            ->addColumn('kecamatan.name', function ($kelu) {
                return $kelu->kecamatan->name;
            })
            ->addColumn('action', function ($kelu) {
                return view('kelurahan.action', [
                    'object' => $kelu
                ]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Kelurahan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Kelurahan $model)
    {
        return $model->with(['kecamatan'])
            ->select('kelurahans.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('kelurahan-table')
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
            Column::computed('kode')->title('Kode'),
            Column::make('name')->title('Nama Kelurahan')->addClass('text-center'),
            Column::computed('kecamatan.name')->title('Nama Kecamatan')->addClass('text-center'),
            Column::computed('status')->title('Status')->addClass('text-center'),
            Column::computed('action')->title('Action')->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Kelurahan_' . date('YmdHis');
    }
}

<?php

namespace App\DataTables;

use App\Models\Kecamatan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KecamatanDataTable extends DataTable
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
            ->editColumn('kode', function ($keca) {
                return $keca->code;
            })
            ->addColumn('status', function ($keca) {
                return $keca->status == TRUE ? 'ACTIVE' : 'INACTIVE';
            })
            ->addColumn('action', function ($keca) {
                return view('kecamatan.action', [
                    'object' => $keca
                ]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Kecamatan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Kecamatan $model)
    {
        return $model->with(['provinsi'])
            ->select('kecamatans.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('kecamatan-table')
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
            Column::make('name')->title('Nama Kecamatan')->addClass('text-center'),
            Column::computed('status')->title('Nama Kecamatan')->addClass('text-center'),
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
        return 'Kecamatan_' . date('YmdHis');
    }
}

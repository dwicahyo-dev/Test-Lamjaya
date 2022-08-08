<?php

namespace App\DataTables;

use App\Models\Pegawai;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PegawaiDataTable extends DataTable
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
            ->addColumn('kecamatan.name', function ($pegawai) {
                return $pegawai->kecamatan->name;
            })
            ->addColumn('action', function ($pegawai) {
                return view('pegawai.action', [
                    'object' => $pegawai
                ]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Pegawai $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pegawai $model)
    {
        return $model->with(['kelurahan', 'kecamatan', 'provinsi'])
            ->select('pegawais.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('pegawai-table')
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
            Column::make('name')->title('Nama Pegawai')->addClass('text-center'),
            Column::make('tempat_lahir')->title('Tempat Lahir')->addClass('text-center'),
            Column::make('tanggal_lahir')->title('Tanggal Lahir')->addClass('text-center'),
            Column::make('jenis_kelamin')->title('Jenis Kelamin')->addClass('text-center'),
            Column::make('agama')->title('Agama')->addClass('text-center'),
            Column::make('alamat')->title('Alamat')->addClass('text-center'),
            Column::make('alamat')->title('Alamat')->addClass('text-center'),

            Column::computed('kelurahan.name')->title('Nama Kelurahan')->addClass('text-center'),
            Column::computed('kecamatan.name')->title('Nama Kecamatan')->addClass('text-center'),
            Column::computed('provinsi.name')->title('Nama Provinsi')->addClass('text-center'),

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
        return 'Pegawai_' . date('YmdHis');
    }
}

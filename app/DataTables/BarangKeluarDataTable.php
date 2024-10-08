<?php

namespace App\DataTables;

use App\Models\BarangKeluar;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BarangKeluarDataTable extends DataTable
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
            ->addColumn('action', function ($item) {
                $html = '';
                $html = '<div class="btn-group btn-group-sm">';
                $html .= '<button onclick="edit(\'' . $item->uid . '\')" type="button" class="btn btn-sm btn-info" title="Edit"><i class="fas fa-pen"></i></button>';
                $html .= '<button onclick="destroy(\'' . $item->uid . '\')" type="button" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></button>';
                $html .= '</div>';
                return $html;
            })
            ->addColumn('nomor_bukti', function ($data) {
                return '<a href="javascript:show(\'' . $data->uid . '\')">' . $data->nomor_bukti . '</a>';
            })
            ->filterColumn('nomor_bukti', function ($query, $keyword) {
                $query->where('nomor_bukti', 'like', "%{$keyword}%");
            })
            ->addColumn('tipe', function ($data) {
                if (strtolower($data->tipe) == "ekspor") {
                    return '<span class="badge badge-lg badge-info">' . $data->tipe . '</span>';
                } else {
                    return '<span class="badge badge-lg badge-success">' . $data->tipe . '</span>';
                }
            })
            ->filterColumn('tipe', function ($query, $keyword) {
                // Apply the filter directly to the `tipe` column
                $query->where('tipe', 'like', "%{$keyword}%");
            })
            ->addColumn('customer', function ($data) {
                $customer = "";
                if (isset($data->customer)) {
                    $customer = $data->customer->nama;
                }
                return $customer;
            })
            ->filterColumn('customer', function ($query, $keyword) {
                // Assuming you have a relationship between the user and role (e.g., user->role->name)
                $query->whereHas('customer', function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['action', 'nomor_bukti', 'tipe']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\BarangKeluar $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BarangKeluar $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        $button = [];
        // $button[] = Button::make('excel')->text('<span title="Export Excel"><i class="fa fa-file-excel"></i></span>');
        $button[] = Button::raw('<i class="fa fa-plus"></i> Create Pengeluaran Barang Jadi')->action('function() { create() }');
        return $this->builder()
            ->parameters([
                'language' => [
                    'search' => '<i class="fas fa-search"></i>',
                    'infoFiltered' => ''
                ],
            ])
            ->setTableId('barangkeluar-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-6'B><'col-sm-3'f><'col-sm-3'l>> <'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>")
            ->orderBy(1)
            ->scrollY(350)
            ->scrollX(false)
            // ->selectStyleSingle()
            ->buttons($button);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('tanggal_bukti')->title("Tanggal")
                ->width(80),
            Column::make('nomor_bukti')->title("Bukti"),
            Column::make('customer'),
            Column::make('tipe'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'BarangKeluar_' . date('YmdHis');
    }
}

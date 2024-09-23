<?php

namespace App\DataTables;

use App\Models\BahanKeluar;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BahanKeluarDataTable extends DataTable
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
            ->addColumn('bagian', function ($data) {
                $bagian = "";
                if (isset($data->bagian)) {
                    $bagian = $data->bagian->nama;
                }
                return $bagian;
            })
            ->addColumn('transaksi', function ($data) {
                if (strtolower($data->transaksi) == "keluar") {
                    return '<span class="badge badge-lg badge-info">' . $data->transaksi . '</span>';
                } else {
                    return '<span class="badge badge-lg badge-success">' . $data->transaksi . '</span>';
                }
            })
            ->filterColumn('bagian', function ($query, $keyword) {
                // Assuming you have a relationship between the user and role (e.g., user->role->name)
                $query->whereHas('bagian', function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('transaksi', function ($query, $keyword) {
                $query->where('transaksi', 'like', "%{$keyword}%");
            })
            ->rawColumns(['action', 'transaksi']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\BahanKeluar $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BahanKeluar $model): QueryBuilder
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
        $button[] = Button::raw('<i class="fa fa-plus"></i> Create Pengeluaran Bahan Baku')->action('function() { create() }');
        return $this->builder()
            ->parameters([
                'language' => [
                    'search' => '<i class="fas fa-search"></i>',
                    'infoFiltered' => ''
                ],
            ])
            ->setTableId('bahankeluar-table')
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
        $button = [];
        // $button[] = Button::make('excel')->text('<span title="Export Excel"><i class="fa fa-file-excel"></i></span>');
        $button[] = Button::raw('<i class="fa fa-plus"></i> Create')->action('function() { create() }');
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('tanggal_bukti')->title("Tanggal")
                ->width(80),
            Column::make('nomor_bukti')->title("Bukti"),
            Column::make('transaksi'),
            Column::make('bagian')->title("Penerima"),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'BahanKeluar_' . date('YmdHis');
    }
}

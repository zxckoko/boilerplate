<?php

namespace App\DataTables;

use App\Models\Article;
use Barryvdh\Snappy\PdfWrapper; // zzzz
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Response; // zzzz
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Exceptions\Exception; // zzzz
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ArticlesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'articles.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Article $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('articles-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax(route('articles.ajax'))
//                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    //->orderBy(2)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('title'),
            Column::make('head'),
            Column::make('body'),
//            Column::make('title')->render('function() { return data.substr(0,32) + "..."; }'),
//            Column::make('head')->render('function() { return data.substr(0,128) + "..."; }'),
//            Column::make('body')->render('function() { return data.substr(0,128) + "..."; }'),
                    Column::computed('action')
                        ->exportable(false)
                        ->printable(false)
                        ->addClass('text-right'),
        ];
    }

    // overridden, similar except for the addition of $snappy->setTimeout()
    // $snappy->setTimeout() defaults to sixty(60) seconds
    public function snappyPdf(): Response
    {
        if (! class_exists(PdfWrapper::class)) {
            throw new Exception('Please `composer require barryvdh/laravel-snappy` to be able to use this feature.');
        }

        /** @var \Barryvdh\Snappy\PdfWrapper $snappy */
        $snappy = app('snappy.pdf.wrapper');
        $options = (array) config('datatables-buttons.snappy.options');

        /** @var string $orientation */
        $orientation = config('datatables-buttons.snappy.orientation');

        $snappy->setOptions($options)->setOrientation($orientation);
        $snappy->setTimeout(60 * 10);

        return $snappy->loadHTML($this->printPreview())->download($this->getFilename().'.pdf');
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Articles_' . date('YmdHis');
    }
}

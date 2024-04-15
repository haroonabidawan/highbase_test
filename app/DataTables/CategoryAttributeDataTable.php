<?php

namespace App\DataTables;

use App\Models\CategoryAttribute;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoryAttributeDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('type', fn ($query) => $query->type->label())
            ->editColumn('required', fn ($query) => $query->is_required->label())
            ->editColumn('category', fn ($query) => $query->category?->name)
            ->addColumn('action', 'admin.category-attribute.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(CategoryAttribute $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $tableClasses = 'd-flex justify-content-between align-items-center';

        return $this->builder()
            ->setTableId('CategoryAttribute-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('<"' . $tableClasses . '"Blf><t><"' . $tableClasses . '"ip>')
            ->orderBy(1);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('category'),
            Column::make('name'),
            Column::computed('type'),
            Column::computed('required'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'CategoryAttributes_' . date('YmdHis');
    }
}

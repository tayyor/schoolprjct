<?php

namespace App\DataTables;

use App\Application;
use Yajra\DataTables\Services\DataTable;

class ApplicationDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Boat $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Application $model)
    {
        return $model->newQuery()->select([
            'applications.id','applications.name','units.name as unit', 'applications.contact','applications.age_range','applications.income_range','applications.family_size'
        ])
            ->leftJoin('units', 'applications.unit_id', 'units.id');
        // ->where('role', '!=', User::$SYSTEM_ADMIN_ROLE);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->removeColumn('id')
            ->minifiedAjax()
//            ->addAction(['width' => '10px'])
            ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'name',
            'unit',
            'contact',
            'age_range',
            'income_range',
            'family_size'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Application_' . date('YmdHis');
    }
}

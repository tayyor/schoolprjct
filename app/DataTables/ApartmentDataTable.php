<?php

namespace App\DataTables;

use App\Apartment;
use Yajra\DataTables\Services\DataTable;

class ApartmentDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function($one){
                $menu = '<a href='. route('apartment.table',$one->id).' title="Edit" style="margin-right: 10px"><i class="zmdi zmdi-edit"></i></a>';

                return $menu;
            })
            ->setRowClass(function($one){
                if(request()->route()->parameter('id') == $one->id){
                    return 'text-warning';
                }
                if(!$one->active){
                    return 'text-primary';
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Boat $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Apartment $model)
    {
        return $model->newQuery()->select([
            'apartments.id','apartments.name','apartments.location', 'apartments.state','apartments.address','apartments.type','users.name as landlord'
        ])
            ->leftJoin('users', 'apartments.owner_id', 'users.id');
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
            ->addAction(['width' => '10px'])
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
            'landlord',
            'location',
            'state',
            'address',
            'type'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Apartment_' . date('YmdHis');
    }
}

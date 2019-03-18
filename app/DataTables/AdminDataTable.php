<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;

class AdminDataTable extends DataTable
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
                $menu = '<a href="'.route('admin.manage', $one->id).'" title="Edit" style="margin-right: 10px"><i class="zmdi zmdi-edit"></i></a>';
                if($one->active) {
                    $menu .= '<a href="' . route('admin.suspend.unsuspend', $one->id) . '" title="Suspend"><i class="zmdi zmdi-close-circle-o text-danger"></i></a>';
                }
                else{
                    $menu .= '<a href="' . route('admin.suspend.unsuspend', $one->id) . '" title="Re-Activate"><i class="zmdi zmdi-check-circle text-success"></i></a>';
                }
                return $menu;
            })
            ->editColumn('role', function($one){
                return User::getRoles()[$one->role];
            })
            ->setRowClass(function($one){
                if(request()->route()->parameter('id') == $one->id){
                    return 'text-warning';
                }
                if(!$one->active){
                    return 'text-danger';
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->select([
            'users.id','users.name', 'active', 'role'
        ]);
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
            'role'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin_' . date('YmdHis');
    }
}

<?php

namespace App\DataTables;

use App\Unit;
use Yajra\DataTables\Services\DataTable;

class UnitDataTable extends DataTable
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
             $menu = '<a href="'.route('application.apply').'" title="Apply" style="margin-right: 10px"><i class="zmdi zmdi-check-circle"></i></a>';
             $menu .= '<a href="/manage'.'/'.$one->id.'" title="Edit" style="margin-right: 10px"><i class="zmdi zmdi-edit"></i></a>';
				if($one->occupied==0)
                                {
                                    $menu .= '<a href="'.route('unit.activate_deactivate', $one->id).'" title="Occupy" style="margin-right: 10px"><i class="zmdi zmdi-check text-danger"></i></a>';

                                }
                                if($one->occupied==1)
                                {
                                    $menu .= '<a href="'.route('unit.activate_deactivate', $one->id).'" title="Unoccupy" style="margin-right: 10px"><i class="zmdi zmdi-close text-success"></i></a>';

                                }
                return $menu;
            })
            ->setRowClass(function($one){
                if(request()->route()->parameter('id') == $one->id){
                    return 'text-warning';
                }
                if(!$one->occupied){
                    return 'text-success';
                }
                if($one->occupied){
                    return 'text-danger';
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Boat $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Unit $model)
    { ;
        return $model->newQuery()->select([
            'units.id','units.name','units.occupied', 'units.rental_amount','units.contact','units.security_deposit','apartments.name as apartment','users.name as landlord','apartments.address','apartments.state'
        ])

		->leftJoin('apartments', 'units.apartment_id', 'apartments.id')
		->leftJoin('users', 'apartments.owner_id', 'users.id');
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
			'rental_amount',
			'contact',
			'state',
            'landlord',
            'apartment',
			'address',
			'security_deposit'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Unit_' . date('YmdHis');
    }
}

<?php

namespace App\DataTables;

use App\Trip;
use Yajra\DataTables\Services\DataTable;

class TripDataTable extends DataTable
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
			    ->addColumn('departure_type', function($one) {
            if($one->depature_type==1){
                return 'Depart when Full';
            }
            elseif($one->depature_type==2){
                return 'Depart at'. $one->depature_time;
            }
        }) ->addColumn('status', function($one) {
            if($one->status==0){
                return 'Created';
            }
            elseif($one->status==1){
                return 'Ongoing';
            }
			 elseif($one->status==3){
                return 'Ended';
            }
			 elseif($one->status==4){
                return 'Cancelled';
            }
			else{
				return 'Failed';
			}
        })
			->addColumn('action', function($one) {
				$menu='';
				if($one->status==0){
				 $menu .= '<a href="'.route('trip.passenger',[request()->route('id'),$one->id]).'" title="Add Passengers" style="margin-right: 10px"><i class="zmdi zmdi-plus text-warning"></i></a>';
				}
				if($one->status==0)
				{
				$menu .= '<a href="'.route('trip.start', $one->id).'" title="Start Trip" style="margin-right: 10px"><i class="zmdi zmdi-check-square"></i></a>';	
				}
				elseif($one->status==1)
				{
				$menu .='<a href="'.route('trip.complete', $one->id).'" title="End Trip" style="margin-right: 10px"><i class="zmdi zmdi-close-circle text-danger"></i></a>';
				$menu .='<a href="'.route('trip.cancel', $one->id).'" title="Cancel Trip" style="margin-right: 10px"><i class="zmdi zmdi-minus-square text-warning"></i></a>';
				}
                $menu .= '<a href="'.route('trip.view',[request()->route('id'),$one->id]).'" title="View Trip" style="margin-right: 10px"><i class="zmdi zmdi-eye text-success"></i></a>';
                return $menu;
			 })
            ->setRowClass(function($one){
                if(request()->route()->parameter('id') == $one->id){
                    return 'text-warning';
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Trip $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Trip $model)
    {
        return $model->newQuery()->select([
            'trips.id','from.name as departure_jetty','to.name as destination_jetty','boats.name as boat_name','boats.capacity','depature_time','depature_type','trips.status'
        ])
		
        ->leftJoin('boats', 'trips.boat_id', 'boats.id')
		->leftJoin('jetties as from', 'trips.from_jetty', 'from.id')
		->leftJoin('jetties as to', 'trips.to_jetty', 'to.id')
        ->where('boats.operator',request()->route('id'));
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
            'boat_name',
			'departure_jetty',
			'status',
			'destination_jetty',
			'departure_type',
			'capacity',
			'depature_time'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'trip_' . date('YmdHis');
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\DataTables\ProjectEvaluationDataTable;
use App\Http\Resources\ProjectMonitoringResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ProjectStatusUpdateResource;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ProjectDataTable;
use Illuminate\Support\Facades\Response;
use App\Core\Returns;
use App\Core\Project as ProjectCore;
use App\Core\Helpers;
use App\DataTables\ProjectMonitorDataTable;
use App\ProjectMonitoring;

class ProjectController extends Controller
{
    //
    public function all(ProjectDataTable $dataTable){
        $dataTable->filterResult(request());
        $data = $dataTable->api();
        $timeItTook = 0;
        if(isset($data['queries'])){
            foreach($data['queries'] as $queries){
                $timeItTook+= $queries['time'];
            }
            unset($data['queries']);
        }
        unset($data['draw']);
        $data['time'] = $timeItTook;
        $data['timeUnit'] = 'ms';
        return Response::json(Returns::ok($data));
    }

    public function one(Request $request, $id){
        $project = Project::find($id);
        if($project){
            //$project->geo = Helpers::convertPointsToDegree($project->location);
            return Response::json(Returns::ok(new ProjectResource($project)));
        }
        return Response::json(Returns::notfoundError(['id'=>'Project not Found']));
    }

    public function monitor(Request $request, $id){
        $project = Project::find($id);
        if($project){
            //post a monitoring
            return Response::json(ProjectCore::monitor($project, $request));
        }
        return Response::json(Returns::notfoundError(['id'=>'Project not Found']));
    }

    public function get_monitor(ProjectMonitorDataTable $dataTable, $id){
        $project = Project::find($id);
        if($project){
            $dataTable->filterResult(request());
            $data = $dataTable->api($id);
            $timeItTook = 0;
            if(isset($data['queries'])){
                foreach($data['queries'] as $queries){
                    $timeItTook+= $queries['time'];
                }
                unset($data['queries']);
            }
            unset($data['draw']);
            $data['time'] = $timeItTook;
            $data['timeUnit'] = 'ms';
            return Response::json(Returns::ok($data));
        }
        return Response::json(Returns::notfoundError(['id'=>'Project not Found']));
    }

    public function get_evaluate(ProjectEvaluationDataTable $dataTable, $id){
        $project = Project::find($id);
        if($project){
            $dataTable->filterResult(request());
            $data = $dataTable->api($id);
            $timeItTook = 0;
            if(isset($data['queries'])){
                foreach($data['queries'] as $queries){
                    $timeItTook+= $queries['time'];
                }
                unset($data['queries']);
            }
            unset($data['draw']);
            $data['time'] = $timeItTook;
            $data['timeUnit'] = 'ms';
            return Response::json(Returns::ok($data));
        }
        return Response::json(Returns::notfoundError(['id'=>'Project not Found']));
    }

    public function get_a_monitor(Request $request, $monitor_id){
        $monitoring = ProjectMonitoring::find($monitor_id);
        if($monitoring){
            return Response::json(Returns::ok(new ProjectMonitoringResource($monitoring)));
        }
        return Response::json(Returns::notfoundError(['id'=>'Project Monitoring not Found']));
    }

    public function evaluate(Request $request, $id, $eval_id=null){
        $project = Project::find($id);
        if($project){
            //post an evaluation
            return Response::json(Returns::ok(ProjectCore::evaluate($project, $request, $eval_id)));
        }
        return Response::json(Returns::notfoundError(['id'=>'Project not Found']));
    }

    public function get_history(Request $request, $id){
        $project = Project::find($id);
        if($project){
            return Response::json(Returns::ok(ProjectStatusUpdateResource::collection($project->statuses)));
        }
        return Response::json(Returns::notfoundError(['id'=>'Project not Found']));
    }

}

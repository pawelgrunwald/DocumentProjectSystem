<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Project;
use App\Models\Step;
use App\Repositories\UserRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\StepRepository;

class StepController extends Controller
{

	public function __construct(){
        $this->middleware('auth');
    }

    public function showSteps(StepRepository $stepRepo, ProjectRepository $projectRepo ,$projectName, $projectID) {

    	if (Auth::user()->type != 'user') {
			return redirect()->route('login');
		}
		$project = $projectRepo->find($projectID);
		if ($project->user_id != Auth::user()->id && Auth::user()->type != 'admin') {
			return redirect('projects');
		}
		$steps = $stepRepo->getAllSteps(Auth::user()->id, $projectID)->paginate(8);

		return view('stepsProject.list', ['steps' => $steps,
										'projectName' => $projectName,
										'projectID'=> $projectID]);
	}

	public function showDetailsStep(ProjectRepository $projectRepo, $projectName, $projectID,StepRepository $stepRepo, $stepID) {
		if (Auth::user()->type != 'user') {
			return redirect()->route('login');
		}

		$project = $projectRepo->find($projectID);
		if ($project->user_id != Auth::user()->id && Auth::user()->type != 'admin') {
			return redirect('projects');
		}

		$step = $stepRepo->find($stepID);

		return view('stepsProject.show', ['step' => $step]);
	}

	public function create(ProjectRepository $projectRepo, $name, $id) {
		if (Auth::user()->type != 'user') {
			return redirect()->route('login');
		}
		$project = $projectRepo->find($id);
		if ($project->user_id != Auth::user()->id && Auth::user()->type != 'admin') {
			return redirect('projects');
		}
		return view('stepsProject.create', ['projectName' => $name,
											'projectID' => $id]);
	}

	public function store(Request $request, ProjectRepository $projectRepo) {
		if (Auth::user()->type != 'user') {
			return redirect()->route('login');
		}

		$projectName = $request->input('projectName');
		$projectID = $request->input('projectID');

		$project = $projectRepo->find($projectID);
		if ($project->user_id != Auth::user()->id && Auth::user()->type != 'admin') {
			return redirect('projects');
		}

		$request->validate([
			'name' => 'required|max:140',
			'describe' => 'required',
		]);

		$describe_field = strip_tags($request->input('describe'), '<br><ul><ol><li><h4><h5><h6><p>');

		$step = new Step;
		$step->project_id = $request->input('projectID');
		$step->name = $request->input('name');
		$step->describe = $describe_field;
		$step->status = 'Nie zaczęty';
		$step->save();

		return redirect('steps/'.$projectName.'/'.$projectID);
	}

	public function edit(ProjectRepository $projectRepo, $projectName, $projectID, StepRepository $stepRepo, $stepID) {
		if (Auth::user()->type != 'user') {
			return redirect()->route('login');
		}

		$project = $projectRepo->find($projectID);
		if ($project->user_id != Auth::user()->id && Auth::user()->type != 'admin') {
			return redirect('projects');
		}

		$step = $stepRepo->find($stepID);
		return view('stepsProject.edit', ['step' => $step,
										'projectID' => $projectID,
										'projectName' => $projectName]);
	}

	public function editStore(Request $request, ProjectRepository $projectRepo, StepRepository $stepRepo) {
		if (Auth::user()->type != 'user') {
			return redirect()->route('login');
		}

		$projectName = $request->input('projectName');
		$projectID = $request->input('projectID');
		$project = $projectRepo->find($request->input('projectID'));
		if ($project->user_id != Auth::user()->id && Auth::user()->type != 'admin') {
			return redirect('projects');
		}

		$request->validate([
			'name' => 'required|min:1|max:140',
			'describe' => 'required|min:1',
		]);

		$describe_field = strip_tags($request->input('describe'), '<br><ul><ol><li><h4><h5><h6><p>');

		$step = $stepRepo->find($request->input('stepID'));
		$step->project_id = $request->input('projectID');
		$step->name = $request->input('name');
		$step->describe = $describe_field;
		if ($request->input('status') == null) {
			$step->status = $step->status;
		} else {
			$step->status = $request->input('status');
		}
		$step->save();

		return redirect('steps/'.$projectName.'/'.$projectID);
	}

	public function set(ProjectRepository $projectRepo, $projectName, $projectID, StepRepository $stepRepo, $stepID, $action) {
		if (Auth::user()->type != 'user') {
			return redirect()->route('login');
		}
		$status = [];
		$project = $projectRepo->find($projectID);
		if ($project->user_id != Auth::user()->id && Auth::user()->type != 'admin') {
			return redirect('projects');
		}

		if ($action == 'during') {
			$status = ['status' => 'W trakcie'];
		} else if ($action == 'finite') {
			$status = ['status' => 'Skończony'];
		}

		$stepRepo->update($stepID, $status);

		return redirect('steps/'.$projectName.'/'.$projectID);
	}

	public function delete(ProjectRepository $projectRepo, $projectName, $projectID, StepRepository $stepRepo, $stepID) {
		if (Auth::user()->type != 'user') {
			return redirect()->route('login');
		}

		$project = $projectRepo->find($projectID);
		if ($project->user_id != Auth::user()->id && Auth::user()->type != 'admin') {
			return redirect('projects');
		}

		$stepRepo->delete($stepID);
		return redirect('steps/'.$projectName.'/'.$projectID);
	}
	
}

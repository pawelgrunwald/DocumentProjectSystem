<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Project;
use App\Repositories\UserRepository;
use App\Repositories\ProjectRepository;

class ProjectController extends Controller
{

	public function __construct(){
        $this->middleware('auth');
    }

    public function index(ProjectRepository $projectRepo) {

		if (Auth::user()->type != 'user' && Auth::user()->type != 'admin') {
			return redirect()->route('login');
		}
		if (Auth::user()->type == 'user') {
			$projects = $projectRepo->getAllProjectsUser()->where('users.id', '=', Auth::user()->id)->paginate(8);
		} else {
			$projects = $projectRepo->getAllProjectsUser()->paginate(8);
		}

		return view('projects.list', ['projects' => $projects]);
	}
    
	public function create() {
		if (Auth::user()->type != 'user') {
			return redirect()->route('login');
		}
		return view('projects.create');
	}

	public function store(Request $request) {
		if (Auth::user()->type != 'user') {
			return redirect()->route('login');
		}

		$request->validate([
			'name' => 'required|max:140'
		]);

		$project = new Project;
		$project->name = $request->input('name');
		$project->user_id = Auth::user()->id;
		$project->save();

		return redirect('projects');
	}

	public function edit(ProjectRepository $projectRepo, $projectID) {
		if (Auth::user()->type != 'user' && Auth::user()->type != 'admin') {
			return redirect()->route('login');
		}
		$project = $projectRepo->find($projectID);
		if ($project->user_id != Auth::user()->id && Auth::user()->type != 'admin') {
			return redirect('projects');
		}

		return view('projects.edit', ['project' => $project]);
	}

	public function editStore(Request $request, ProjectRepository $projectRepo) {
		if (Auth::user()->type != 'user' && Auth::user()->type != 'admin') {
			return redirect()->route('login');
		}
		$project = $projectRepo->find($request->input('projectID'));
		if ($project->user_id != Auth::user()->id && Auth::user()->type != 'admin') {
			return redirect('projects');
		}

		$request->validate([
			'name' => 'required|min:1|max:140'
		]);

		$project->name = $request->input('name');
		$project->save();

		return redirect('projects');
	}

	public function delete(ProjectRepository $projectRepo, $projectID) {
		if (Auth::user()->type != 'user' && Auth::user()->type != 'admin') {
			return redirect()->route('login');
		}
		$project = $projectRepo->find($projectID);
		if ($project->user_id != Auth::user()->id && Auth::user()->type != 'admin') {
			return redirect('projects');
		}

		$projectRepo->delete($projectID);

		return redirect('projects');
	}

}


<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\User;
use App\Models\Step;

use DB;

Class StepRepository extends BaseRepository {

	public function __construct(Step $model) {
		$this->model = $model;
	}

	public function getAllSteps($id, $project_id) {
		return DB::table('users')
            ->join('projects', 'users.id', '=', 'projects.user_id')
            ->join('steps', 'projects.id', '=', 'steps.project_id')
            ->select(DB::raw('steps.*'))
            ->where('users.id', '=', $id)
            ->where('steps.project_id', '=', $project_id);
	}

}
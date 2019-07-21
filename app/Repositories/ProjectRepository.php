<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\User;

use DB;

Class ProjectRepository extends BaseRepository {

	public function __construct(Project $model) {
		$this->model = $model;
	}

	public function getAllProjectsUser() {
		return DB::table('users')
            ->join('projects', 'users.id', '=', 'projects.user_id')
            ->select(DB::raw('projects.id, projects.name as projectName'),DB::raw('users.name as userName'));
	}
}
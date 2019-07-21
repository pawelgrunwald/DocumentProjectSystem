<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Project;

use DB;

Class UserRepository extends BaseRepository {

	public function __construct(User $model) {
		$this->model = $model;
	}

	
}
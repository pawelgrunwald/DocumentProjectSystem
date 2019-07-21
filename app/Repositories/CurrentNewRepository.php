<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\CurrentNew;

use DB;

Class CurrentNewRepository extends BaseRepository {

	public function __construct(CurrentNew $model) {
		$this->model = $model;
	}

	public function getAllNews(){
		return $this->model->orderBy('date', 'desc')->paginate(5);
	}

}
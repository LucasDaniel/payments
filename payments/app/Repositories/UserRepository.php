<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
	public function __construct() {
		$this->model = new User();
	}

	public function findUserTypeWallet(int $id): object|null {
		return $this->model::select('users.id','users.name','users.cpf','users.email','tu.type','w.value')
					->join('type_users as tu', 'tu.id', '=', 'users.id_type')
					->join('wallets as w', 'w.id_user', '=', 'users.id')
					->where('users.id',$id)
					->get()
					->first();
	}

	public function getTypeUser(int $id): object|null {
		return $this->model::select('tu.type')
					->join('type_users as tu', 'tu.id', '=', 'users.id_type')
					->where('users.id',$id)
					->get()
					->first();
	}
}
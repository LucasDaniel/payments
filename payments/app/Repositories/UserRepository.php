<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
	/**
     * Begin the model
     */
	public function __construct() {
		$this->model = new User();
	}

	/**
     * Find the user his type and wallet by id
	 * @param int
	 * @return object or null
     */
	public function findUserTypeWallet(int $id): object|null {
		return $this->model::select('users.id','users.name','users.cpf','users.email','tu.type','w.value')
					->join('type_users as tu', 'tu.id', '=', 'users.id_type')
					->join('wallets as w', 'w.id_user', '=', 'users.id')
					->where('users.id',$id)
					->get()
					->first();
	}

	/**
     * Find the type of user by id user
	 * @param int
	 * @return object or null
     */
	public function getTypeUser(int $id): object|null {
		return $this->model::select('tu.type')
					->join('type_users as tu', 'tu.id', '=', 'users.id_type')
					->where('users.id',$id)
					->get()
					->first();
	}
}
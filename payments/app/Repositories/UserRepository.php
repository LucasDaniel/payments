<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{

	public static function find(int $id): User|null {
		return User::find($id);
	}

	public static function findUserTypeWallet(int $id): object|null {
		return User::select('users.id','users.name','users.cpf','users.email','tu.type','w.value')
					->join('type_users as tu', 'tu.id', '=', 'users.id_type')
					->join('wallets as w', 'w.id_user', '=', 'users.id')
					->where('users.id',$id)
					->get()
					->first();
	}

	public static function getTypeUser($id): object|null {
		return User::select('tu.type')
					->join('type_users as tu', 'tu.id', '=', 'users.id_type')
					->where('users.id',$id)
					->get()
					->first();
	}
}
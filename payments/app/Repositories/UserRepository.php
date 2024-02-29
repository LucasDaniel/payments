<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
	public static function findUserTypeWallet($id) {
		return User::find($id)
					->select('users.id','users.name','users.cpf','users.email','tu.type','w.value')
					->join('type_users as tu', 'tu.id', '=', 'users.id_type')
					->join('wallets as w', 'w.id_user', '=', 'users.id')
					->get()
					->first();
	}

	public static function getTypeUser($id) {
		return User::find($id)
					->select('tu.type')
					->join('type_users as tu', 'tu.id', '=', 'users.id_type')
					->get()
					->first();
	}
}
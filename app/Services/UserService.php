<?php

namespace App\Services;

use App\Models\Relationship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService {


    /**
     * Returns users data based on request parameter(s)
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsers(Request $request) {
        $query = User::query();
        $target = $request->get('term');

        if(!empty($target)) {
            $query->whereRaw('LOWER(email) like \'%'. $target .'%\' ')
                ->orWhereRaw('LOWER(name) like \'%'. $target .'%\' ')
                ->orWhereRaw('LOWER(surname) like \'%'. $target .'%\' ');
        }
        $query->select('users.id', 'users.name', 'users.surname', 'users.email', DB::raw("(case when rs.status is not null then rs.status else rs2.status end) as status"));

        $query->leftJoin('relationships as rs', 'rs.sender_id', '=', 'users.id');
        $query->leftJoin('relationships as rs2', 'rs2.receiver_id', '=', 'users.id');
        $query->where('users.id', '!=', Auth::id());
        $data = $query->get()->all();
        return response()->json(['results' => $data]);
    }

    public function getSuggestions() {
        $query = Relationship::query();
        $query->select('users.name', 'users.email', 'users.surname', 'relationships.id', 'relationships.status');
        $query->join('users', 'users.id', '=', 'relationships.sender_id');
        $query->where('receiver_id', '=', Auth::user()->id);
        $query->where('status', '!=', Relationship::APPROVED);
        return $query->get();
    }

    public function createUser(Request $request) {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->surname = $request->get('surname');
        $user->password = Hash::make($request->get('password'));
        $user->save();
        return $user;
    }
}

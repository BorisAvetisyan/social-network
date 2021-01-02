<?php

namespace App\Services;

use App\Models\Relationship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService {


    /**
     * Returns users data based on request parameter(s)
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsers(Request $request) {
        $query = User::query();
        if(!empty($target)) {
            $query->whereRaw('LOWER(email) like \'%'. $target .'%\' ')
                ->orWhereRaw('LOWER(name) like \'%'. $target .'%\' ')
                ->orWhereRaw('LOWER(surname) like \'%'. $target .'%\' ');
        }
        $query->where('id', "!=", Auth::user()->id);
        $users = $query->get()->all();
        return response()->json(['results' => $users]);
    }

    /** Creates new relation */
    public function createRelation(User $user) {
        $relationship = new Relationship();
        $relationship->sender_id = Auth::user()->id;
        $relationship->receiver_id = $user->id;
        $relationship->status = Relationship::PENDING;
        try {
            $relationship->save();
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => "Something went wrong"]);
        }
        return response()->json(['success' => true]);
    }

    /** Removes relation row from the database */
    public function removeRelation() {
        return response()->json([]);
    }

    public function getSuggestions() {
        $query = Relationship::query();
        $query->select('users.name', 'users.email', 'users.surname', 'relationships.id', 'relationships.status');
        $query->join('users', 'users.id', '=', 'relationships.sender_id');
        $query->where('receiver_id', '=', Auth::user()->id);
        $query->where('status', '!=', Relationship::APPROVED);
        return $query->get();
    }

    public function getRequestedList() {

        return response()->json([]);
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

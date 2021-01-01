<?php

namespace App\Http\Controllers;

use App\Models\Relationship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    /**
     * Users search functionality
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request) {
        $target = $request->get('term');

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

    /**
     * Creates new relationship row with corresponding sender and receiver ids.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function friend(Request $request) {
        $user = $request->get('user');
        if(!is_numeric($user)) {
            return response()->json(['success' => false, 'message' => 'Invalid arguments are specified']);
        }
        $user = User::find($user);
        if(empty($user)) {
            return response()->json(['success' => false, 'message' => 'Invalid arguments are specified']);
        }
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

    public function unfriend() {

    }

}

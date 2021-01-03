<?php

namespace App\Http\Controllers;

use App\Models\Relationship;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $userService;

    /**
     * UsersController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService) {
         $this->userService = $userService;
    }

    /**
     * Users search functionality
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request) {
        return $this->userService->getAllUsers($request);
    }


    /**
     * Returns users data with filtered condition friends/approved/rejected
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request) {
        return $this->userService->getUsers($request);
    }

    /**
     * Returns all notifications where receiver is the authenticated user and the status is "pending"
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function notifications(Request $request) {
        $query = User::query();
        $query->select('relationships.id', 'users.name', 'users.email', 'users.surname', 'relationships.status');
        $query->join('relationships', 'relationships.receiver_id', '=', 'users.id');
        $query->where('relationships.receiver_id','=', user()->id);

        $query->where('relationships.status', '=', Relationship::PENDING);

        $this->userService->applyPaginationCondition($request, $query);

        $data = $query->get()->all();
        return response()->json([
            'meta' => $this->userService->getMetaInformation($request->get('pagination', []), count($data)),
            'data' => $data
        ]);
    }
}

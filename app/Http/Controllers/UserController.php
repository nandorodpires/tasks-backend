<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('api.jwt', ['except' => ['store']]);
    }

    public function store(Request $request)
    {
        try {
            $user = $this->user->create($request->all());
            return response()->json($user, 201);
        } catch (\Exception $e) {
            if ((int)$e->getCode() === 23000) {
                return response()->json(['message' => 'Usuário já cadastrado!'], 400);
            }
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

}

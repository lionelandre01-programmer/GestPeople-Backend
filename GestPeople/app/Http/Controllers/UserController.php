<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\UserService;

class UserController extends Controller
{

    use AuthorizesRequests;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(StoreUserRequest $request){

        $validatedData = $request->validated();

        $user = $this->userService->create($validatedData);

        return response()->json(['message' => 'Usuário Cadastrado com sucesso']);

    }

    public function login(Request $request)
    {

        $user = $this->userService->login($request);

        if ($user instanceof \Illuminate\Http\JsonResponse) {

            return $user;

        }else{
            
            return response()->json([
            'token' => $user->createToken('api-token')->plainTextToken,
            'user' => $user
            ]);
        }    
  
    }

    public function logout()
    {

        $messege = $this->userService->logout();

        return response()->json(['messege' => $messege]);
    }

    public function getAuth()
    {
        $user = $this->userService->getAuth();

        if ($user){

            return response()->json([
            'token' => Auth::user()->currentAcessToken(),
            'user' => $user
            ]);

        }else{

            return response()->json(['message' => 'Usuário não autenticado']);

        }
        
    }

    public function update(StoreUserRequest $request)
    {

        $this->authorize('update', User::class);

        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('perfil', 'public');
        }

        $user = $this->userService->update($validatedData);

        return response()->json(['user' => $user]);
    }

    public function allUsers(){

        $this->authorize('view', User::class);

        $users = $this->userService->view();

        return response()->json($users);

    }

    public function bestsUser(){

        $this->authorize('view', User::class);

        $bestUsers = ($this->userService->bestUser());

        return response()->json($bestUsers);

    }

    public function userSuspended(){
        
        $this->authorize('view', User::class);

        $suspendedUsers = $this->userService->userSuspended();

        return response()->json($suspendedUsers);
    }

    public function activeUsers(){

        $this->authorize('view', User::class);

        $usersActive = $this->userService->activeUsers();

        return response()->json(['count' => $usersActive]);
        
    }
    
}

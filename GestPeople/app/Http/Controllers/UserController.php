<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    use AuthorizesRequests;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    //Função responsável por cadastrar usuário
    public function store(StoreUserRequest $request){

        $validatedData = $request->validated();

        $user = $this->userService->create($validatedData);

        return response()->json(['message' => 'Usuário Cadastrado com sucesso']);

    }

    //Função responsável por realizar o login do usuário
    public function login(Request $request)
    {
        //User::where('id',1)->update(['password' => Hash::make($request->password)]);

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

    //Função responsável por fazer o logout
    public function logout()
    {

        $messege = $this->userService->logout();

        return response()->json(['messege' => $messege]);
    }

    //Função responsável por actualizar informações do usuário
    public function update(StoreUserRequest $request)
    {

        $this->authorize('update', User::class);

        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('perfil', 'public');
        }

        return response()->json($this->userService->update($validatedData));
    }

    //Função responsável por retornar todos os usuários (funcionários)
    public function allUsers(){

        $this->authorize('view', User::class);

        $users = $this->userService->view();

        return response()->json($users);

    }

    //Função responsável por retornar o melhor funcionário
    public function bestsUser(){

        $this->authorize('view', User::class);

        $bestUsers = ($this->userService->bestUser());

        return response()->json($bestUsers);

    }

    /*Função responsável por retornar os funcionários com seus
    últimos registros na tabela suspensaos
    */
    public function lastSuspensao(){
        
        $this->authorize('view', User::class);

        $suspendedUsers = $this->userService->userSuspended();

        return response()->json(['user' => $suspendedUsers]);
    }

    //Função responsável por trazer todos os funcionários de cada departamento
    public function depAllUser(){

        $this->authorize('view', User::class);

        return response()->json(['users' => $this->userService->depAllUser()]);

    }
    
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function registration(Request $request)
    {
        $data = [
            'phone_number' => $request->phone_number,
            'username' => $request->username,
            'password' => $request->password,
            'region_id' => $request->region_id,
            'district_id' => $request->district_id,
            'adress' => $request->adress,
            'role_id' => $request->role_id
        ];
        // return $data;
        User::create($data);
        return response()->json([
            'message' => "successfully registered !"
        ]);
    }

    // public function login(SignInRequest $request)
    // {
    //     $hash = Hash::make($request->password);
    //     $user = User::where('username', $request->username && 'password', $hash)->get();
    //     if (isset($user)) 
    //     {
    //         $token = $user->create("ishonch-cash-backend")->plainTextToken;
    //         return response()->json(["token" => $token], 200);

    //     }
    //     return response()->json(["message" => "username yoki parol noto'g'ri"], 400);
    //     // $user?->tokens()?->delete();
    //     // $token = $user->createToken(env("APP_NAME") ?? "ishonch-cash-backend")->plainTextToken;
    //     // return response()->json(["token" => $token], 200);
    //    return 1212;
    //     {
    //         return response()->json(["message" => "Login yoki parol noto'g'ri"], 400);
    //         $user->tokens()->delete();

    //         return response()->json(["token" => $token], 200);
    //     }
    // }  


    public function login(SignInRequest $request)
    {
        // The validation will automatically happen before this code executes
        $validated = $request->validated();

        // Retrieve a single user based on the username
        $user = User::where('username', $validated['username'])->first();

        // Check if the user exists and the password is correct
        if ($user && Hash::check($validated['password'], $user->password)) {
            // If authentication is successful, create a token for the user
            $token = $user->createToken("ishonch-cash-backend")->plainTextToken;

            // Return the token as a response
            return response()->json(['token' => $token], 200);
        }

        // If authentication fails
        return response()->json(['message' => 'Invalid username or password'], 400);
    }



    public function indexForAdmin(Request $request)
    {

        $region_id = request('region_id', null);
        $phone_number = request('phone_number', null);
        $username = request('username', null);
        $district_id = request('district_id', null);
        $dateFromRequest = request('date_from', date('Y-m-d'));
        $dateToRequest = request('date_to', date('Y-m-d'));
        $dateFrom = Carbon::createFromFormat('Y-m-d', $dateFromRequest)->startOfCentury();
        $dateTo = Carbon::createFromFormat('Y-m-d', $dateToRequest)->endOfDay();
        $role_id = request('role_id', null);
        $id = request('id', null);

        // $user = auth()->user();
        return User::where('id', $id ? "=" : "!=", $id)
            ->where('phone_number', $phone_number ? "=" : "!=", $phone_number)
            ->where('region_id', $region_id ? "=" : "!=", $region_id)
            ->where('username', $username ? "=" : "!=", $username)
            ->where('district_id', $district_id ? "=" : "!=", $district_id)
            ->where('role_id', $role_id ? "=" : "!=", $role_id)
            ->where('active', true)
            ->whereBetween('created_at', [$dateFrom, $dateTo])
            ->select(
                'phone_number',
                'username',
                'region_id',
                'district_id',
                'adress',
                'created_at'
            )
            ->get();
    }

    // In your controller

    public function index()
    {
        $user = auth()->user();

        // Use eager loading with `with` to get the related region and district names
        $userDetails = User::where('users.id', $user->id)
            //    ->with(['region:id,regions', 'district:id,districts']) // Eager load region and district
            ->join('regions', 'regions.id', 'users.region_id')
            ->join('districts', 'districts.id', 'users.district_id')
            ->select('phone_number  as tel nomer', 'username', 'regions', 'districts', 'adress')
            ->get();

        //    return new UserResource($userDetails);
        // return UserResource::collection($userDetails);

        // Now return the user data, including the related names
        return response()->json([
            "message" => $userDetails
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$this->check('user', 'add')) {
            return response()->json(['message' => ("You don't have permission!")], 403);
        }

        User::create([
            'phone_number'  => $request->phone_number,
            'username'      => $request->username,
            'password'      => $request->password,
            'region_id'     => $request->region_id,
            'district_id'   => $request->district_id,
            'adress'        => $request->adress,
            'role_id'       => $request->role_id
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        //     if(!$this->check('user', 'update')){
        //         return response()->json(['message' =>("You don't have permission!")],403);
        //     }  return 2222;   
        $requestUser = auth()->user();
        $user = User::where('id', $requestUser->id)->first();
        $user->update([
            'phone_number'  => request('phone_number', $requestUser->phone_number),
            'username'  => request('username', $requestUser->username),
            'password'  => request('password', $requestUser->password),
            'region_id'  => request('region_id', $requestUser->region_id),
            'district_id'  => request('district_id', $requestUser->district_id),
            'adress'  => request('adress', $requestUser->adress),
            'role_id'  => request('role_id', $requestUser->role_id),

        ]);
        return response()->json(["message" => "successfully updated"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->check('user', 'delete')) {
            return response()->json(['message' => ("You don't have permission!")], 403);
        }
        $user = User::find($id);
        if (!isset($user)) {
            return response()->json(["message" => "user not found"]);
        }
        $user->update([
            "active" => false
        ]);
        return response()->json(["message" => "user archived"]);
    }
}

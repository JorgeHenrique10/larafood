<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:clients,email'],
            'password' => ['required', 'min:4', 'max:8'],
            'device_name' => ['required', 'min:3', 'max:50']
        ]);

        $client = Client::where('email', $request->email)->first();

        if (!Hash::check($request->password, $client->password)) {
            return response()->json(['message' => 'Credenciais Inválidas'], 404);
        }

        $token = $client->createToken($request->device_name)->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    public function me(Request $request)
    {
        $client = $request->user();

        return new ClientResource($client);
    }

    public function logout(Request $request)
    {
        $client = $request->user();
        //Revoke all tokens Clients
        $client->tokens()->delete();

        return response()->json([], 204);
    }
}

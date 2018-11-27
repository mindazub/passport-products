<?php

declare( strict_types = 1);

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Token;

/**
 * Class AuthController
 * @package App\Http\Controllers\API
 */
class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function register(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|email|string|max:191|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);


        if($validator->fails())
        {
            return response(['errors' => $validator->errors()->all()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $request['password'] = Hash::make($request['password']);

        /** @var User $user*/
        $user = User::create($request->toArray());

        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        return response($token, JsonResponse::HTTP_OK);
    }


    /**
     * @param Request $request
     * @return Response
     */
    public function login(Request $request): Response
    {
        /** @var User $user */
        $user = User::where('email', '=', $request->email)->first();

        if($user)
        {

            if(Hash::check($request->password, $user->password))
            {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token ];

                // gauni vis nauja tokena, jei kas nors nugrabintu tokena, kad nepasiimtu duomenu.

                return response($response, JsonResponse::HTTP_OK);
            } else {
                $response = 'Incorrect password';
                return response($response, JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
        } else {
            $response = 'Your credentials incorrect';
            return response($response, JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request): Response
    {
        /** @var Token $token */
        $token = $request->user()->token();
        $token->revoke();

        $response = 'You have succesfully logout';
        return response($response, Response::HTTP_OK);
    }
}

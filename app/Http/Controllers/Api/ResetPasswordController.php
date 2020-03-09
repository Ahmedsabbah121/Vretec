<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{

    use ResetsPasswords;

    protected function sendResetResponse(Request $request, $response)
    {
        return response(['message'=>$response]);
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response(['error'=>$response], $status = 422);
    }

}

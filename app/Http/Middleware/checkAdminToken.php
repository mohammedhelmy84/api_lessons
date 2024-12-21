<?php

namespace App\Http\Middleware;

use App\Http\Traits\GeneralTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class checkAdminToken
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = null;
        try {
            $user = JWTAuth::parseToken()->authenticate();
                //throw an exception

        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                // return response() -> json(['success' => false, 'msg' => 'INVALID _TOKEN']);
                return $this->returnError('0','INVALID _TOKEN');
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                // return response() -> json(['success' =>false, 'msg'=>'EXPIRED_TOKEN']);
                return $this->returnError('0','EXPIRED_TOKEN');
            } else{
                // return response() -> json(['success' => false, 'msg' => 'Error']);
                return $this->returnError('0','Error');
            }
        }

            if (!$user){
                // return response()->json(['success'=>false,'msg'=>trans('Unauthenticated')],200);
                return $this->returnError(trans('Unauthenticated'));
            }
            return $next($request);
    }



}

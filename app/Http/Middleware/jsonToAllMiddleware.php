<?php

namespace App\Http\Middleware;

use Closure;

class JsonToAllMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(in_array($request->method(),['put','post','patch'])&&$request->isJson()){
            $data = $request->json()->all();
            $request->request->replace(count($data)?$data:[]);
        }
        return $next($request);
    }
}

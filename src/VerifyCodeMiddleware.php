<?php

namespace Hitmanv\Laverify;

use Illuminate\Http\Request;
use Closure;

class VerifyCodeMiddleware 
{
    public function handle(Request $request, Closure $next, $type, $targetKey, $codeKey)
    {

        $target = $request->get($targetKey);
        $code = $request->get($codeKey);

        if(!VerifyCode::verify($type, $target, $code)) {
            throw new VerifyCodeException();
        }

        return $next($request);
    }


}
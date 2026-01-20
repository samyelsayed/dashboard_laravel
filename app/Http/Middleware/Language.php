<?php

namespace App\Http\Middleware;

use App\Http\traits\ApiTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class Language
{   use ApiTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $language = $request->header('accept-language'); 
        //  dd($language);
         if(is_null($language)){
         return $this->ErrorMessage([] , 'missed language key' , 422);
         }
        $allowedLanguage = ['ar','en'];
        if(!in_array($language,$allowedLanguage)){
         return $this->ErrorMessage(["lang"=> "Supported Language are: ". implode("," , $allowedLanguage)] , 'Not Supported Language ' , 422);
        }
        App::setLocale($language);
        return $next($request);
    }
}

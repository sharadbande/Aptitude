<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;


class candidateSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
         $candidate_id = Session::get('candidate_id');
        //  echo "we are in candidateSession: Middleware With candidate id".$candidate_id;
        if(!isset($candidate_id) || empty($candidate_id)){
            return redirect("Generate-Quiz")->with('error-message', 'ohh! You are not authorized to access this Aptitude exam...! please fill form first');

        }

        return $next($request);
    }
}

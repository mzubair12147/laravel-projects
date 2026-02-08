<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request ) {
        return match (auth()->user()->role) {
            'admin' => redirect()->route("admin.dashboard"),
            'instructor' => redirect()->route("instructor.dashboard"),
            'member' => redirect()->route("member.dashboard"),
            default => redirect()->route("login"),
        };
    }
}

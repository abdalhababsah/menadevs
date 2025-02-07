<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Redirect based on the user's role.
        // Assuming role_id: 1 = Admin, 2 = Reviewer, 3 = Attempter.
        switch ($user->role_id) {
            case 1:
                return redirect()->route('admin.dashboard');
            case 2:
                return redirect()->route('reviewer.dashboard'); // Ensure the route name matches your route definition.
            case 3:
                return redirect()->route('attempter.dashboard');
            default:
                // Optionally, handle other cases or abort.
                abort(403, 'Unauthorized access.');
        }
    }
}
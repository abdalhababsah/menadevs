<?php

namespace App\Http\Controllers\Attempter;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Attempter\TaskingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskingController extends Controller
{
    protected $taskingService;

    public function __construct(TaskingService $taskingService)
    {
        $this->taskingService = $taskingService;
    }

    /**
     * Display the next task for the logged-in attempter.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function start(Request $request)
    {

        $user = Auth::user();
        if (!$user instanceof User || $user->role_id != 3) {
            return redirect()->back()->with('error', 'User not authenticated.');
        }

        // Use the TaskingService to get the next task based on our priority logic.
        $task = $this->taskingService->startTasking($user);

        if ($task) {
            // You might need to transform the raw DB result into a Task model or an array before sending it to the view.
            return response()->view('attempter.tasks.start', compact('task'));
        } else {
            return view('dashboard-layouts.partials.empty-queue')->with('error', 'No available tasks at this time.');
        }
    }
}
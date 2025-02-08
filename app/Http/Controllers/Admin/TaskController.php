<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateTaskRequest;
use App\Models\Category;
use App\Models\Language;
use App\Models\Dimension;
use App\Services\Admin\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display the create task form.
     */
    public function create()
    {
        $categories = Category::all();
        $languages = Language::all();
        $dimensions = Dimension::all();
        return view('admin.tasks.create', compact('categories', 'languages', 'dimensions'));
    }

        /**
     * Display available tasks with filters.
     */
    public function availableTasks(Request $request)
    {
        $filters = $request->only(['category_id', 'language_id']);
        $result = $this->taskService->getAvailableTasks($filters);

        $tasks = $result['tasks'];
        $totalTasks = $result['count'];

        // Fetch filter options
        $categories = Category::all();
        $languages = Language::all();
        $dimensions = Dimension::all();

        return view('admin.tasks.available-tasks', compact('tasks', 'totalTasks', 'categories', 'languages', 'dimensions'));
    }
    /**
     * Store a new task with dimensions.
     */
    public function store(CreateTaskRequest $request)
    {
        $this->taskService->createTask($request->validated());

        return redirect()->route('admin.tasks.create')->with('success', 'Tasks created successfully.');
    }
}
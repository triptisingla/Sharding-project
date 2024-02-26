<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Services\ShardingService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsersByName(Request $request)
    {
        $name = $request->input('name');

        // Instantiate ShardingService
        $shardingService = new ShardingService();

        // Retrieve users from sharded databases based on the provided name
        $users = $shardingService->getUsersByShardName($name);

        // Return response or perform further actions
        return response()->json($users);
    }
}

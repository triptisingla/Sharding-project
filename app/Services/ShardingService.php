<?php


namespace App\Services;

use Illuminate\Support\Facades\DB;

class ShardingService
{
    public function getUsersByShardName($name)
    {
        // $shardService = new ShardingService();
        // $shardConnection = $shardService->getShardConnection($name);
        $shardConnection = $this->getShardConnection($name);

        return DB::connection($shardConnection)->table('users')->where('name', $name)->get();
    }


    public function getShardConnection($name)
    {
        // Implement your sharding logic here
        // For example, you can use consistent hashing or a lookup table

        // Sample logic: Use shard1 for names starting with A-M, and shard2 for names starting with N-Z
        $shard = ord(strtoupper($name[0])) <= ord('M') ? 'shard1' : 'shard2';
        
        return $shard;
    }
}

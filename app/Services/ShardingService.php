<?php


namespace App\Services;

use Illuminate\Support\Facades\DB;

class ShardingService
{
    public function getUsersByShardName($name, $email)
    {
        // $shardService = new ShardingService();
        // $shardConnection = $shardService->getShardConnection($name);
        // $shardConnection = $this->getShardConnection($name);
        $shardConnection = $this->getShardConnection($name, $email);

        return DB::connection($shardConnection)->table('users')->where('name', $name)->get();
    }


    public function getShardConnection($name, $email)
    {
        // Implement your sharding logic here
        // For example, you can use consistent hashing or a lookup table

        // Sample logic: Use shard1 for names starting with A-M, and shard2 for names starting with N-Z

        // $shard = ord(strtoupper($name[0])) <= ord('M') ? 'shard1' : 'shard2';

        /////////////////////////based on key name/////////////////////////////


        ///////////////////////based on hash value ///////////////////////////////////////////////////

        $concatStr = $name . $email;

        $shard = ($this->hashString($concatStr) % 2 == 0) ? 'shard2' : 'shard1';

        // dd($shard, $hashValue);

        return $shard;
    }

    public function hashString($concatStr)
    {
        $hashValue = 0;


        // Iterate through each character in the string
        for ($i = 0; $i < strlen($concatStr); $i++) {
            // Convert character to its ASCII value and add to hashValue
            $hashValue += ord($concatStr[$i]);
        }
        // dd($hashValue);
        return $hashValue;
    }

}

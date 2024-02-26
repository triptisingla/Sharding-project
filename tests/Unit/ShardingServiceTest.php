<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\ShardingService;

class ShardingServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    // public function testShardConnection()
    // {
    //     // Create an instance of ShardingService
    //     $shardingService = new ShardingService();

    //     // Test with different names to ensure they are correctly assigned to shards
    //     $shardConnection1 = $shardingService->getShardConnection('John');
    //     $shardConnection2 = $shardingService->getShardConnection('Alice');
    //     $shardConnection3 = $shardingService->getShardConnection('Zob');

    //     // Assert that the shard connections are as expected
    //     $this->assertEquals('shard1', $shardConnection1);
    //     $this->assertEquals('shard1', $shardConnection2);
    //     $this->assertEquals('shard2', $shardConnection3);
    // }
}

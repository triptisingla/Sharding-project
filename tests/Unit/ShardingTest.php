<?php

namespace Tests\Unit;



use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
use App\Services\ShardingService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;


// use Illuminate\Config\Repository\app;
class ShardingTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    use DatabaseTransactions;

    protected $shardingService;

    public function setUp(): void
    {
        parent::setUp();
        $this->shardingService = new ShardingService();
    }

    public function testInsertData()
    {
        // Test data to be inserted
        $userData = [
            'name' => 'fhaad',
            'email' => 'fhhaad@example.com',
            'password' => 'password', // Assuming you are hashing passwords
        ];

        // Determine the shard connection based on the user's name
        $shardConnection = $this->shardingService->getShardConnection($userData['name']);



        $userData['shard_id'] = ($shardConnection == 'shard1' ? 1 : 2);
        // Set the default database connection to the determined shard connection
        DB::setDefaultConnection($shardConnection);
        // config(['database.default' => $shardConnection]);

        // $databaseManager = app('db');
        // $databaseManager->setDefaultConnection($shardConnection);
        // $this->app['config']->set('database.default', $shardConnection);

        // Insert the user data into the users table
        DB::table('users')->insert($userData);

        // Retrieve the inserted data from the users table
        $insertedUser = DB::table('users')->where('name', $userData['name'])->first();

        // Assertions
        $this->assertNotNull($insertedUser);
        $this->assertEquals($userData['name'], $insertedUser->name);
        $this->assertEquals($userData['email'], $insertedUser->email);
    }
}

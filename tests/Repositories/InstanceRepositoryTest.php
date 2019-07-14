<?php namespace Tests\Repositories;

use App\Models\Instance;
use App\Repositories\InstanceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeInstanceTrait;
use Tests\ApiTestTrait;

class InstanceRepositoryTest extends TestCase
{
    use MakeInstanceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var InstanceRepository
     */
    protected $instanceRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->instanceRepo = \App::make(InstanceRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_instance()
    {
        $instance = $this->fakeInstanceData();
        $createdInstance = $this->instanceRepo->create($instance);
        $createdInstance = $createdInstance->toArray();
        $this->assertArrayHasKey('id', $createdInstance);
        $this->assertNotNull($createdInstance['id'], 'Created Instance must have id specified');
        $this->assertNotNull(Instance::find($createdInstance['id']), 'Instance with given id must be in DB');
        $this->assertModelData($instance, $createdInstance);
    }

    /**
     * @test read
     */
    public function test_read_instance()
    {
        $instance = $this->makeInstance();
        $dbInstance = $this->instanceRepo->find($instance->id);
        $dbInstance = $dbInstance->toArray();
        $this->assertModelData($instance->toArray(), $dbInstance);
    }

    /**
     * @test update
     */
    public function test_update_instance()
    {
        $instance = $this->makeInstance();
        $fakeInstance = $this->fakeInstanceData();
        $updatedInstance = $this->instanceRepo->update($fakeInstance, $instance->id);
        $this->assertModelData($fakeInstance, $updatedInstance->toArray());
        $dbInstance = $this->instanceRepo->find($instance->id);
        $this->assertModelData($fakeInstance, $dbInstance->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_instance()
    {
        $instance = $this->makeInstance();
        $resp = $this->instanceRepo->delete($instance->id);
        $this->assertTrue($resp);
        $this->assertNull(Instance::find($instance->id), 'Instance should not exist in DB');
    }
}

<?php namespace Tests\Repositories;

use App\Models\DeviceType;
use App\Repositories\DeviceTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeDeviceTypeTrait;
use Tests\ApiTestTrait;

class DeviceTypeRepositoryTest extends TestCase
{
    use MakeDeviceTypeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DeviceTypeRepository
     */
    protected $deviceTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->deviceTypeRepo = \App::make(DeviceTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_device_type()
    {
        $deviceType = $this->fakeDeviceTypeData();
        $createdDeviceType = $this->deviceTypeRepo->create($deviceType);
        $createdDeviceType = $createdDeviceType->toArray();
        $this->assertArrayHasKey('id', $createdDeviceType);
        $this->assertNotNull($createdDeviceType['id'], 'Created DeviceType must have id specified');
        $this->assertNotNull(DeviceType::find($createdDeviceType['id']), 'DeviceType with given id must be in DB');
        $this->assertModelData($deviceType, $createdDeviceType);
    }

    /**
     * @test read
     */
    public function test_read_device_type()
    {
        $deviceType = $this->makeDeviceType();
        $dbDeviceType = $this->deviceTypeRepo->find($deviceType->id);
        $dbDeviceType = $dbDeviceType->toArray();
        $this->assertModelData($deviceType->toArray(), $dbDeviceType);
    }

    /**
     * @test update
     */
    public function test_update_device_type()
    {
        $deviceType = $this->makeDeviceType();
        $fakeDeviceType = $this->fakeDeviceTypeData();
        $updatedDeviceType = $this->deviceTypeRepo->update($fakeDeviceType, $deviceType->id);
        $this->assertModelData($fakeDeviceType, $updatedDeviceType->toArray());
        $dbDeviceType = $this->deviceTypeRepo->find($deviceType->id);
        $this->assertModelData($fakeDeviceType, $dbDeviceType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_device_type()
    {
        $deviceType = $this->makeDeviceType();
        $resp = $this->deviceTypeRepo->delete($deviceType->id);
        $this->assertTrue($resp);
        $this->assertNull(DeviceType::find($deviceType->id), 'DeviceType should not exist in DB');
    }
}

<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeDeviceTrait;
use Tests\ApiTestTrait;

class DeviceApiTest extends TestCase
{
    use MakeDeviceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_device()
    {
        $device = $this->fakeDeviceData();
        $this->response = $this->json('POST', '/api/devices', $device);

        $this->assertApiResponse($device);
    }

    /**
     * @test
     */
    public function test_read_device()
    {
        $device = $this->makeDevice();
        $this->response = $this->json('GET', '/api/devices/'.$device->id);

        $this->assertApiResponse($device->toArray());
    }

    /**
     * @test
     */
    public function test_update_device()
    {
        $device = $this->makeDevice();
        $editedDevice = $this->fakeDeviceData();

        $this->response = $this->json('PUT', '/api/devices/'.$device->id, $editedDevice);

        $this->assertApiResponse($editedDevice);
    }

    /**
     * @test
     */
    public function test_delete_device()
    {
        $device = $this->makeDevice();
        $this->response = $this->json('DELETE', '/api/devices/'.$device->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/devices/'.$device->id);

        $this->response->assertStatus(404);
    }
}

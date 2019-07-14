<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeDeviceTypeTrait;
use Tests\ApiTestTrait;

class DeviceTypeApiTest extends TestCase
{
    use MakeDeviceTypeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_device_type()
    {
        $deviceType = $this->fakeDeviceTypeData();
        $this->response = $this->json('POST', '/api/deviceTypes', $deviceType);

        $this->assertApiResponse($deviceType);
    }

    /**
     * @test
     */
    public function test_read_device_type()
    {
        $deviceType = $this->makeDeviceType();
        $this->response = $this->json('GET', '/api/deviceTypes/'.$deviceType->id);

        $this->assertApiResponse($deviceType->toArray());
    }

    /**
     * @test
     */
    public function test_update_device_type()
    {
        $deviceType = $this->makeDeviceType();
        $editedDeviceType = $this->fakeDeviceTypeData();

        $this->response = $this->json('PUT', '/api/deviceTypes/'.$deviceType->id, $editedDeviceType);

        $this->assertApiResponse($editedDeviceType);
    }

    /**
     * @test
     */
    public function test_delete_device_type()
    {
        $deviceType = $this->makeDeviceType();
        $this->response = $this->json('DELETE', '/api/deviceTypes/'.$deviceType->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/deviceTypes/'.$deviceType->id);

        $this->response->assertStatus(404);
    }
}

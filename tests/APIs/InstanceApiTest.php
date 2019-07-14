<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeInstanceTrait;
use Tests\ApiTestTrait;

class InstanceApiTest extends TestCase
{
    use MakeInstanceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_instance()
    {
        $instance = $this->fakeInstanceData();
        $this->response = $this->json('POST', '/api/instances', $instance);

        $this->assertApiResponse($instance);
    }

    /**
     * @test
     */
    public function test_read_instance()
    {
        $instance = $this->makeInstance();
        $this->response = $this->json('GET', '/api/instances/'.$instance->id);

        $this->assertApiResponse($instance->toArray());
    }

    /**
     * @test
     */
    public function test_update_instance()
    {
        $instance = $this->makeInstance();
        $editedInstance = $this->fakeInstanceData();

        $this->response = $this->json('PUT', '/api/instances/'.$instance->id, $editedInstance);

        $this->assertApiResponse($editedInstance);
    }

    /**
     * @test
     */
    public function test_delete_instance()
    {
        $instance = $this->makeInstance();
        $this->response = $this->json('DELETE', '/api/instances/'.$instance->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/instances/'.$instance->id);

        $this->response->assertStatus(404);
    }
}

<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeAttributableTrait;
use Tests\ApiTestTrait;

class AttributableApiTest extends TestCase
{
    use MakeAttributableTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_attributable()
    {
        $attributable = $this->fakeAttributableData();
        $this->response = $this->json('POST', '/api/attributables', $attributable);

        $this->assertApiResponse($attributable);
    }

    /**
     * @test
     */
    public function test_read_attributable()
    {
        $attributable = $this->makeAttributable();
        $this->response = $this->json('GET', '/api/attributables/'.$attributable->id);

        $this->assertApiResponse($attributable->toArray());
    }

    /**
     * @test
     */
    public function test_update_attributable()
    {
        $attributable = $this->makeAttributable();
        $editedAttributable = $this->fakeAttributableData();

        $this->response = $this->json('PUT', '/api/attributables/'.$attributable->id, $editedAttributable);

        $this->assertApiResponse($editedAttributable);
    }

    /**
     * @test
     */
    public function test_delete_attributable()
    {
        $attributable = $this->makeAttributable();
        $this->response = $this->json('DELETE', '/api/attributables/'.$attributable->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/attributables/'.$attributable->id);

        $this->response->assertStatus(404);
    }
}

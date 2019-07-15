<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeAttributeTrait;
use Tests\ApiTestTrait;

class AttributeApiTest extends TestCase
{
    use MakeAttributeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_attribute()
    {
        $attribute = $this->fakeAttributeData();
        $this->response = $this->json('POST', '/api/attributes', $attribute);

        $this->assertApiResponse($attribute);
    }

    /**
     * @test
     */
    public function test_read_attribute()
    {
        $attribute = $this->makeAttribute();
        $this->response = $this->json('GET', '/api/attributes/'.$attribute->id);

        $this->assertApiResponse($attribute->toArray());
    }

    /**
     * @test
     */
    public function test_update_attribute()
    {
        $attribute = $this->makeAttribute();
        $editedAttribute = $this->fakeAttributeData();

        $this->response = $this->json('PUT', '/api/attributes/'.$attribute->id, $editedAttribute);

        $this->assertApiResponse($editedAttribute);
    }

    /**
     * @test
     */
    public function test_delete_attribute()
    {
        $attribute = $this->makeAttribute();
        $this->response = $this->json('DELETE', '/api/attributes/'.$attribute->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/attributes/'.$attribute->id);

        $this->response->assertStatus(404);
    }
}

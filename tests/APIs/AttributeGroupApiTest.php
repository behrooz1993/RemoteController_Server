<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeAttributeGroupTrait;
use Tests\ApiTestTrait;

class AttributeGroupApiTest extends TestCase
{
    use MakeAttributeGroupTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_attribute_group()
    {
        $attributeGroup = $this->fakeAttributeGroupData();
        $this->response = $this->json('POST', '/api/attributeGroups', $attributeGroup);

        $this->assertApiResponse($attributeGroup);
    }

    /**
     * @test
     */
    public function test_read_attribute_group()
    {
        $attributeGroup = $this->makeAttributeGroup();
        $this->response = $this->json('GET', '/api/attributeGroups/'.$attributeGroup->id);

        $this->assertApiResponse($attributeGroup->toArray());
    }

    /**
     * @test
     */
    public function test_update_attribute_group()
    {
        $attributeGroup = $this->makeAttributeGroup();
        $editedAttributeGroup = $this->fakeAttributeGroupData();

        $this->response = $this->json('PUT', '/api/attributeGroups/'.$attributeGroup->id, $editedAttributeGroup);

        $this->assertApiResponse($editedAttributeGroup);
    }

    /**
     * @test
     */
    public function test_delete_attribute_group()
    {
        $attributeGroup = $this->makeAttributeGroup();
        $this->response = $this->json('DELETE', '/api/attributeGroups/'.$attributeGroup->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/attributeGroups/'.$attributeGroup->id);

        $this->response->assertStatus(404);
    }
}

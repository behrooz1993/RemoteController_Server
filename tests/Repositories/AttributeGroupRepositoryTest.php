<?php namespace Tests\Repositories;

use App\Models\AttributeGroup;
use App\Repositories\AttributeGroupRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeAttributeGroupTrait;
use Tests\ApiTestTrait;

class AttributeGroupRepositoryTest extends TestCase
{
    use MakeAttributeGroupTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var AttributeGroupRepository
     */
    protected $attributeGroupRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->attributeGroupRepo = \App::make(AttributeGroupRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_attribute_group()
    {
        $attributeGroup = $this->fakeAttributeGroupData();
        $createdAttributeGroup = $this->attributeGroupRepo->create($attributeGroup);
        $createdAttributeGroup = $createdAttributeGroup->toArray();
        $this->assertArrayHasKey('id', $createdAttributeGroup);
        $this->assertNotNull($createdAttributeGroup['id'], 'Created AttributeGroup must have id specified');
        $this->assertNotNull(AttributeGroup::find($createdAttributeGroup['id']), 'AttributeGroup with given id must be in DB');
        $this->assertModelData($attributeGroup, $createdAttributeGroup);
    }

    /**
     * @test read
     */
    public function test_read_attribute_group()
    {
        $attributeGroup = $this->makeAttributeGroup();
        $dbAttributeGroup = $this->attributeGroupRepo->find($attributeGroup->id);
        $dbAttributeGroup = $dbAttributeGroup->toArray();
        $this->assertModelData($attributeGroup->toArray(), $dbAttributeGroup);
    }

    /**
     * @test update
     */
    public function test_update_attribute_group()
    {
        $attributeGroup = $this->makeAttributeGroup();
        $fakeAttributeGroup = $this->fakeAttributeGroupData();
        $updatedAttributeGroup = $this->attributeGroupRepo->update($fakeAttributeGroup, $attributeGroup->id);
        $this->assertModelData($fakeAttributeGroup, $updatedAttributeGroup->toArray());
        $dbAttributeGroup = $this->attributeGroupRepo->find($attributeGroup->id);
        $this->assertModelData($fakeAttributeGroup, $dbAttributeGroup->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_attribute_group()
    {
        $attributeGroup = $this->makeAttributeGroup();
        $resp = $this->attributeGroupRepo->delete($attributeGroup->id);
        $this->assertTrue($resp);
        $this->assertNull(AttributeGroup::find($attributeGroup->id), 'AttributeGroup should not exist in DB');
    }
}

<?php namespace Tests\Repositories;

use App\Models\Attribute;
use App\Repositories\AttributeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeAttributeTrait;
use Tests\ApiTestTrait;

class AttributeRepositoryTest extends TestCase
{
    use MakeAttributeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var AttributeRepository
     */
    protected $attributeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->attributeRepo = \App::make(AttributeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_attribute()
    {
        $attribute = $this->fakeAttributeData();
        $createdAttribute = $this->attributeRepo->create($attribute);
        $createdAttribute = $createdAttribute->toArray();
        $this->assertArrayHasKey('id', $createdAttribute);
        $this->assertNotNull($createdAttribute['id'], 'Created Attribute must have id specified');
        $this->assertNotNull(Attribute::find($createdAttribute['id']), 'Attribute with given id must be in DB');
        $this->assertModelData($attribute, $createdAttribute);
    }

    /**
     * @test read
     */
    public function test_read_attribute()
    {
        $attribute = $this->makeAttribute();
        $dbAttribute = $this->attributeRepo->find($attribute->id);
        $dbAttribute = $dbAttribute->toArray();
        $this->assertModelData($attribute->toArray(), $dbAttribute);
    }

    /**
     * @test update
     */
    public function test_update_attribute()
    {
        $attribute = $this->makeAttribute();
        $fakeAttribute = $this->fakeAttributeData();
        $updatedAttribute = $this->attributeRepo->update($fakeAttribute, $attribute->id);
        $this->assertModelData($fakeAttribute, $updatedAttribute->toArray());
        $dbAttribute = $this->attributeRepo->find($attribute->id);
        $this->assertModelData($fakeAttribute, $dbAttribute->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_attribute()
    {
        $attribute = $this->makeAttribute();
        $resp = $this->attributeRepo->delete($attribute->id);
        $this->assertTrue($resp);
        $this->assertNull(Attribute::find($attribute->id), 'Attribute should not exist in DB');
    }
}

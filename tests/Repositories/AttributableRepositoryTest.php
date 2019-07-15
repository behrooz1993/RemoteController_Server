<?php namespace Tests\Repositories;

use App\Models\Attributable;
use App\Repositories\AttributableRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeAttributableTrait;
use Tests\ApiTestTrait;

class AttributableRepositoryTest extends TestCase
{
    use MakeAttributableTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var AttributableRepository
     */
    protected $attributableRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->attributableRepo = \App::make(AttributableRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_attributable()
    {
        $attributable = $this->fakeAttributableData();
        $createdAttributable = $this->attributableRepo->create($attributable);
        $createdAttributable = $createdAttributable->toArray();
        $this->assertArrayHasKey('id', $createdAttributable);
        $this->assertNotNull($createdAttributable['id'], 'Created Attributable must have id specified');
        $this->assertNotNull(Attributable::find($createdAttributable['id']), 'Attributable with given id must be in DB');
        $this->assertModelData($attributable, $createdAttributable);
    }

    /**
     * @test read
     */
    public function test_read_attributable()
    {
        $attributable = $this->makeAttributable();
        $dbAttributable = $this->attributableRepo->find($attributable->id);
        $dbAttributable = $dbAttributable->toArray();
        $this->assertModelData($attributable->toArray(), $dbAttributable);
    }

    /**
     * @test update
     */
    public function test_update_attributable()
    {
        $attributable = $this->makeAttributable();
        $fakeAttributable = $this->fakeAttributableData();
        $updatedAttributable = $this->attributableRepo->update($fakeAttributable, $attributable->id);
        $this->assertModelData($fakeAttributable, $updatedAttributable->toArray());
        $dbAttributable = $this->attributableRepo->find($attributable->id);
        $this->assertModelData($fakeAttributable, $dbAttributable->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_attributable()
    {
        $attributable = $this->makeAttributable();
        $resp = $this->attributableRepo->delete($attributable->id);
        $this->assertTrue($resp);
        $this->assertNull(Attributable::find($attributable->id), 'Attributable should not exist in DB');
    }
}

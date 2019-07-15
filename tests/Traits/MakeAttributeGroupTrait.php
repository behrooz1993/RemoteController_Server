<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\AttributeGroup;
use App\Repositories\AttributeGroupRepository;

trait MakeAttributeGroupTrait
{
    /**
     * Create fake instance of AttributeGroup and save it in database
     *
     * @param array $attributeGroupFields
     * @return AttributeGroup
     */
    public function makeAttributeGroup($attributeGroupFields = [])
    {
        /** @var AttributeGroupRepository $attributeGroupRepo */
        $attributeGroupRepo = \App::make(AttributeGroupRepository::class);
        $theme = $this->fakeAttributeGroupData($attributeGroupFields);
        return $attributeGroupRepo->create($theme);
    }

    /**
     * Get fake instance of AttributeGroup
     *
     * @param array $attributeGroupFields
     * @return AttributeGroup
     */
    public function fakeAttributeGroup($attributeGroupFields = [])
    {
        return new AttributeGroup($this->fakeAttributeGroupData($attributeGroupFields));
    }

    /**
     * Get fake data of AttributeGroup
     *
     * @param array $attributeGroupFields
     * @return array
     */
    public function fakeAttributeGroupData($attributeGroupFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'name' => $fake->word
        ], $attributeGroupFields);
    }
}

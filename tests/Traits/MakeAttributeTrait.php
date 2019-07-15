<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Attribute;
use App\Repositories\AttributeRepository;

trait MakeAttributeTrait
{
    /**
     * Create fake instance of Attribute and save it in database
     *
     * @param array $attributeFields
     * @return Attribute
     */
    public function makeAttribute($attributeFields = [])
    {
        /** @var AttributeRepository $attributeRepo */
        $attributeRepo = \App::make(AttributeRepository::class);
        $theme = $this->fakeAttributeData($attributeFields);
        return $attributeRepo->create($theme);
    }

    /**
     * Get fake instance of Attribute
     *
     * @param array $attributeFields
     * @return Attribute
     */
    public function fakeAttribute($attributeFields = [])
    {
        return new Attribute($this->fakeAttributeData($attributeFields));
    }

    /**
     * Get fake data of Attribute
     *
     * @param array $attributeFields
     * @return array
     */
    public function fakeAttributeData($attributeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'name' => $fake->word
        ], $attributeFields);
    }
}

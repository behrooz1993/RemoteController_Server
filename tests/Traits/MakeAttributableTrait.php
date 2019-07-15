<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Attributable;
use App\Repositories\AttributableRepository;

trait MakeAttributableTrait
{
    /**
     * Create fake instance of Attributable and save it in database
     *
     * @param array $attributableFields
     * @return Attributable
     */
    public function makeAttributable($attributableFields = [])
    {
        /** @var AttributableRepository $attributableRepo */
        $attributableRepo = \App::make(AttributableRepository::class);
        $theme = $this->fakeAttributableData($attributableFields);
        return $attributableRepo->create($theme);
    }

    /**
     * Get fake instance of Attributable
     *
     * @param array $attributableFields
     * @return Attributable
     */
    public function fakeAttributable($attributableFields = [])
    {
        return new Attributable($this->fakeAttributableData($attributableFields));
    }

    /**
     * Get fake data of Attributable
     *
     * @param array $attributableFields
     * @return array
     */
    public function fakeAttributableData($attributableFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'attribute_id' => $fake->randomDigitNotNull,
            'attributable_id' => $fake->randomDigitNotNull,
            'attributable_type' => $fake->word
        ], $attributableFields);
    }
}

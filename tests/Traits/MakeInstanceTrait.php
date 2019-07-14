<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Instance;
use App\Repositories\InstanceRepository;

trait MakeInstanceTrait
{
    /**
     * Create fake instance of Instance and save it in database
     *
     * @param array $instanceFields
     * @return Instance
     */
    public function makeInstance($instanceFields = [])
    {
        /** @var InstanceRepository $instanceRepo */
        $instanceRepo = \App::make(InstanceRepository::class);
        $theme = $this->fakeInstanceData($instanceFields);
        return $instanceRepo->create($theme);
    }

    /**
     * Get fake instance of Instance
     *
     * @param array $instanceFields
     * @return Instance
     */
    public function fakeInstance($instanceFields = [])
    {
        return new Instance($this->fakeInstanceData($instanceFields));
    }

    /**
     * Get fake data of Instance
     *
     * @param array $instanceFields
     * @return array
     */
    public function fakeInstanceData($instanceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'device_id' => $fake->randomDigitNotNull,
            'mobile' => $fake->word,
            'serial' => $fake->word
        ], $instanceFields);
    }
}

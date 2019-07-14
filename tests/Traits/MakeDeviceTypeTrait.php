<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\DeviceType;
use App\Repositories\DeviceTypeRepository;

trait MakeDeviceTypeTrait
{
    /**
     * Create fake instance of DeviceType and save it in database
     *
     * @param array $deviceTypeFields
     * @return DeviceType
     */
    public function makeDeviceType($deviceTypeFields = [])
    {
        /** @var DeviceTypeRepository $deviceTypeRepo */
        $deviceTypeRepo = \App::make(DeviceTypeRepository::class);
        $theme = $this->fakeDeviceTypeData($deviceTypeFields);
        return $deviceTypeRepo->create($theme);
    }

    /**
     * Get fake instance of DeviceType
     *
     * @param array $deviceTypeFields
     * @return DeviceType
     */
    public function fakeDeviceType($deviceTypeFields = [])
    {
        return new DeviceType($this->fakeDeviceTypeData($deviceTypeFields));
    }

    /**
     * Get fake data of DeviceType
     *
     * @param array $deviceTypeFields
     * @return array
     */
    public function fakeDeviceTypeData($deviceTypeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'name' => $fake->word
        ], $deviceTypeFields);
    }
}

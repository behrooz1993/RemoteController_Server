<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSessionTrait;
use Tests\ApiTestTrait;

class SessionApiTest extends TestCase
{
    use MakeSessionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_session()
    {
        $session = $this->fakeSessionData();
        $this->response = $this->json('POST', '/api/sessions', $session);

        $this->assertApiResponse($session);
    }

    /**
     * @test
     */
    public function test_read_session()
    {
        $session = $this->makeSession();
        $this->response = $this->json('GET', '/api/sessions/'.$session->id);

        $this->assertApiResponse($session->toArray());
    }

    /**
     * @test
     */
    public function test_update_session()
    {
        $session = $this->makeSession();
        $editedSession = $this->fakeSessionData();

        $this->response = $this->json('PUT', '/api/sessions/'.$session->id, $editedSession);

        $this->assertApiResponse($editedSession);
    }

    /**
     * @test
     */
    public function test_delete_session()
    {
        $session = $this->makeSession();
        $this->response = $this->json('DELETE', '/api/sessions/'.$session->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/sessions/'.$session->id);

        $this->response->assertStatus(404);
    }
}

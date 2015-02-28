<?php

class ExampleTest extends TestCase
{

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $response = $this->call( 'GET', '/backend/security/roles/index' );

        $this->assertEquals( 404, $response->getStatusCode() );
    }

}

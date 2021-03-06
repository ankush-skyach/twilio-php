<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Events\V1;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class SchemaTest extends HolodeckTestCase {
    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->events->v1->schemas("id")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://events.twilio.com/v1/Schemas/id'
        ));
    }

    public function testFetchResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "id": "DataTaps.TestEventSchema",
                "url": "https://events.twilio.com/v1/Schemas/DataTaps.TestEventSchema",
                "last_created": "2018-07-30T20:00:00Z",
                "last_version": 1,
                "links": {
                    "versions": "https://events.twilio.com/v1/Schemas/DataTaps.TestEventSchema/Versions"
                }
            }
            '
        ));

        $actual = $this->twilio->events->v1->schemas("id")->fetch();

        $this->assertNotNull($actual);
    }
}
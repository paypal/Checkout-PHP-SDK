<?php

namespace Test\Integration\Orders;

use Test\IntegrationTestCase;
use Test\Kit\OrdersCreateRequestTrait;

class OrdersCreateTest extends IntegrationTestCase
{
    use OrdersCreateRequestTrait;

    /**
     * testOrdersCreateRequest
     */
    public function testOrdersCreateRequest()
    {
        $response = $this->createOrdersCreateRequest($this->client);
        $this->assertEquals(201, $response->statusCode);
        $this->assertNotNull($response->result);

        $createdOrder = $response->result;
        $this->assertNotNull($createdOrder->id);
        $this->assertNotNull($createdOrder->purchase_units);
        $this->assertEquals(1, count($createdOrder->purchase_units));
        $firstPurchaseUnit = $createdOrder->purchase_units[0];
        $this->assertEquals("test_ref_id1", $firstPurchaseUnit->reference_id);
        $this->assertEquals("USD", $firstPurchaseUnit->amount->currency_code);
        $this->assertEquals("100.00", $firstPurchaseUnit->amount->value);

        $this->assertNotNull($createdOrder->create_time);
        $this->assertNotNull($createdOrder->links);
        $foundApproveUrl = false;
        foreach ($createdOrder->links as $link) {
            if ("approve" === $link->rel) {
                $foundApproveUrl = true;
                $this->assertNotNull($link->href);
                $this->assertEquals("GET", $link->method);
            }
        }
        $this->assertTrue($foundApproveUrl);
        $this->assertEquals("CREATED", $createdOrder->status);
    }
}

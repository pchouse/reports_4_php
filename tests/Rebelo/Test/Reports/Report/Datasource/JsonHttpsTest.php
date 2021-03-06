<?php

/*
 * The MIT License
 *
 * Copyright 2020 João Rebelo.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
declare(strict_types=1);

namespace Rebelo\Test\Reports\Report\Datasource;

use PHPUnit\Framework\TestCase;
use Rebelo\Reports\Report\Datasource\JsonHttps;
use Rebelo\Reports\Report\Datasource\RequestType;

/**
 * Class JsonHttpsTest
 *
 * @author João Rebelo
 */
class JsonHttpsTest
    extends TestCase
{

    protected $_object;

    protected function setUp()
    {

    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    public function testSetSetGet()
    {
        $jsonHttps = new JsonHttps();

        $this->assertInstanceOf("Rebelo\Reports\Report\Datasource\JsonHttps",
                                $jsonHttps);

        $this->assertNull($jsonHttps->getDatePattern());
        $datePattern = "yyyy-MM-dd";
        $selfDate    = $jsonHttps->setDatePattern($datePattern);
        $this->assertInstanceOf(get_class($jsonHttps), $selfDate);
        $this->assertEquals($datePattern, $jsonHttps->getDatePattern());

        $this->assertNull($jsonHttps->getNumberPattern());
        $numberPattern = "#0,0";
        $selfNum       = $jsonHttps->setNumberPattern($numberPattern);
        $this->assertInstanceOf(get_class($jsonHttps), $selfNum);
        $this->assertEquals($numberPattern, $jsonHttps->getNumberPattern());

        $this->assertNull($jsonHttps->getUrl());
        $url     = "https://test.example";
        $selfUrl = $jsonHttps->setUrl($url);
        $this->assertInstanceOf(get_class($jsonHttps), $selfUrl);
        $this->assertEquals($url, $jsonHttps->getUrl());

        $this->assertEquals(RequestType::GET, $jsonHttps->getType()->get());
        $typePost = new RequestType(RequestType::POST);
        $selfType = $jsonHttps->setType($typePost);
        $this->assertInstanceOf(get_class($jsonHttps), $selfType);
        $this->assertEquals($typePost->get(), $jsonHttps->getType()->get());
        $typeGet  = new RequestType(RequestType::GET);
        $jsonHttps->setType($typeGet);
        $this->assertEquals($typeGet->get(), $jsonHttps->getType()->get());
    }

    public function testInstance()
    {
        $url       = "https://test.example";
        $typePost  = new RequestType(RequestType::POST);
        $jsonHttps = new JsonHttps($url, $typePost);
        $this->assertEquals($url, $jsonHttps->getUrl());
        $this->assertEquals($typePost->get(), $jsonHttps->getType()->get());
    }

    /**
     * @expectedException \Rebelo\Reports\Report\Datasource\DatasourceException
     */
    public function testWrongSchema()
    {
        new JsonHttps("http://test.example");
    }

    /**
     * @expectedException \Rebelo\Reports\Report\Datasource\DatasourceException
     */
    public function testWrongSetSchema()
    {
        $jsonHttps = new JsonHttps();
        $jsonHttps->setUrl("http://test.example");
    }

}

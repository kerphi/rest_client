<?php
// vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 encoding=utf-8 fdm=marker :

/**
 * EasyClientTest
 *
 * Copyright (c) 2010, Nicolas Thouvenin
 *
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the author nor the names of its contributors may be
 *       used to endorse or promote products derived from this software without
 *       specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE REGENTS AND CONTRIBUTORS ``AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE REGENTS AND CONTRIBUTORS BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @category  REST
 * @package   REST_Client
 * @author    Nicolas Thouvenin <nthouvenin@gmail.com>
 * @author    Stéphane Gully <stephane.gully@gmail.com>
 * @copyright 2010 Nicolas Thouvenin
 * @license   http://opensource.org/licenses/bsd-license.php BSD Licence
 * @link      ...
 */

ini_set('include_path', dirname(__FILE__).'/../'.PATH_SEPARATOR.ini_get('include_path'));

require_once 'PHPUnit/Framework.php';
require_once 'REST/EasyClient.php';

/**
 * EasyClientTest.
 *
 * @category  REST
 * @package   REST_Client
 * @author    Nicolas Thouvenin <nthouvenin@gmail.com>
 * @author    Stéphane Gully <stephane.gully@gmail.com>
 * @copyright 2010 Nicolas Thouvenin
 * @license   http://opensource.org/licenses/bsd-license.php BSD Licence
 * @link      ...
 */
class EasyClientTest extends PHPUnit_Framework_TestCase
{
    private $_http_proxy = null;
    
    /**
     * TODO
     *
     * @return ...
     */
    function setUp()
    {
        if (getenv('http_proxy')) {
            $this->_http_proxy = getenv('http_proxy');
        }
    }

    /**
     * TODO
     *
     * @return ...
     */
    function testBasic()
    {
        $response = REST_EasyClient::newInstance()->get('/');
        $this->assertEquals($response->code, 200);
        $this->assertContains('</html>', $response->content);
    }

    /**
     * TODO
     *
     * @return ...
     */
    function testRetro()
    {
        $client = new REST_EasyClient('localhost');
        $response = $client->get('/');
        $this->assertEquals($response->code, 200);
        $this->assertContains('</html>', $response->content);
    }

    /**
     * TODO
     *
     * @return ...
     */
    function testGet()
    {
        $response = REST_EasyClient::newInstance('fr.php.net')->setHttpProxy($this->_http_proxy)->get('/curl');
        $this->assertEquals($response->code, 200);
        $this->assertContains('PHP: cURL - Manual', $response->content);
    }

}

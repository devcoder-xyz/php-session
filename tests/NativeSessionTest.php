<?php

namespace Test\DevCoder\Session;

use DevCoder\Session\Storage\NativeSessionStorage;
use PHPUnit\Framework\TestCase;

$_SESSION = [];

class NativeSessionTest extends TestCase
{
    public function test()
    {
        $session = new NativeSessionStorage();
        $session['username'] = 'myName';
        $this->assertTrue($session->has('username'));
        $session['role'] = 'ADMIN';
        $this->assertTrue($session->has('role'));
        $this->assertSame('myName', $session->get('username'));

        $article = [
            'title' => 'TV',
            'description' => 'lorem',
            'price' => 199.80
        ];
        $session->put('article',$article);
        $this->assertSame($article, $session->get('article'));
        $this->assertIsFloat($session->get('article')['price']);
        $this->assertCount(3, $session->all());

        $this->assertSame(null, $session->get('email'));
        $this->assertSame('dev@devcoder.xyz', $session->get('email', 'dev@devcoder.xyz'));
    }
}

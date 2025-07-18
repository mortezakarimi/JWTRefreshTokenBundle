<?php

namespace Gesdinet\JWTRefreshTokenBundle\Tests\Unit\Request\Extractor;

use Gesdinet\JWTRefreshTokenBundle\Request\Extractor\RequestCookieExtractor;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;

final class RequestCookieExtractorTest extends TestCase
{
    private const PARAMETER_NAME = 'refresh_token';
    private RequestCookieExtractor $requestCookieExtractor;

    protected function setUp(): void
    {
        $this->requestCookieExtractor = new RequestCookieExtractor();
    }

    public function testGetsTheTokenFromTheRequestCookies(): void
    {
        $token = 'my-refresh-token';

        $cookieBag = new InputBag();
        $cookieBag->set(self::PARAMETER_NAME, $token);

        /** @var Request&MockObject $request */
        $request = $this->createMock(Request::class);
        $request->cookies = $cookieBag;

        $this->assertSame(
            $token,
            $this->requestCookieExtractor->getRefreshToken($request, self::PARAMETER_NAME)
        );
    }
}

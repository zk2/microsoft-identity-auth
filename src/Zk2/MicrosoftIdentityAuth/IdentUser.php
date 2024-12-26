<?php

namespace Zk2\MicrosoftIdentityAuth;

use Microsoft\Kiota\Authentication\Oauth\AuthorizationCodeContext;
use Microsoft\Kiota\Authentication\PhpLeagueAuthenticationProvider;
use Microsoft\Kiota\Http\GuzzleRequestAdapter;

readonly class IdentUser
{
    public function __construct(private string $microsoftClientId, private string $microsoftClientSecret){}

    public function identifyUser(string $authorizationCode, string $redirectUri): array
    {
        $tokenRequestContext = new AuthorizationCodeContext(
            'common',
            $this->microsoftClientId,
            $this->microsoftClientSecret,
            $authorizationCode,
            $redirectUri
        );

        $authProvider = new PhpLeagueAuthenticationProvider($tokenRequestContext, ['User.Read'], ['graph.microsoft.com']);
        $requestAdapter = new GuzzleRequestAdapter($authProvider);
        $client = new GraphApiClient($requestAdapter);
        $me = $client->me()->get()->wait();
        return [
            'id' => $me->getId(),
            'email' => $me->getAdditionalData()['mail'] ?? null,
        ];
    }
}
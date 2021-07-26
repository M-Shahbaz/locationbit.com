<?php

namespace App\Domain\Jwt\Service;

use App\Domain\Jwt\Data\JwtAuthData;
use Cake\Chronos\Chronos;
use InvalidArgumentException;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Ecdsa\Sha256;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\ValidationData;
use Ramsey\Uuid\Uuid;
use UnexpectedValueException;

final class JwtAuth
{
    /**
     * @var string The issuer name
     */
    private $issuer;

    /**
     * @var int Max lifetime in seconds
     */
    private $lifetime;

    /**
     * @var string The private key
     */
    private $privateKey;

    /**
     * @var string The public key
     */
    private $publicKey;

    /**
     * @var The signer
     */
    private $signer;

    /**
     * The constructor.
     *
     * @param string $issuer The issuer name
     * @param int $lifetime The max lifetime
     * @param string $privateKey The private key as string
     * @param string $publicKey The public key as string
     */
    public function __construct(
        string $issuer,
        int $lifetime,
        string $privateKey,
        string $publicKey
    ) {
        $this->issuer = $issuer;
        $this->lifetime = $lifetime;
        $this->privateKey = $privateKey;
        $this->publicKey = $publicKey;
        $this->signer = new Sha256();
    }

    /**
     * Get JWT max lifetime.
     *
     * @return int The lifetime in seconds
     */
    public function getLifetime(): int
    {
        return $this->lifetime;
    }

    /**
     * Create JSON web token.
     *
     * @param string $email The user email
     *
     * @throws UnexpectedValueException
     *
     * @return string The JWT
     */
    public function createJwt(JwtAuthData $jwtAuthData): string
    {
        $issuedAt = Chronos::now()->getTimestamp();

        // (JWT ID) Claim, a unique identifier for the JWT
        return (new Builder())->issuedBy($this->issuer)
            ->identifiedBy(Uuid::uuid4()->toString(), true)
            ->issuedAt($jwtAuthData->iat)
            ->canOnlyBeUsedAfter($jwtAuthData->nbf)
            ->expiresAt($jwtAuthData->exp)
            ->withClaim('userId', $jwtAuthData->userId)
            ->withClaim('name', $jwtAuthData->name)
            ->withClaim('email', $jwtAuthData->email)
            ->withClaim('role', $jwtAuthData->role)
            ->getToken($this->signer, new Key($this->privateKey));
    }

    /**
     * Parse token.
     *
     * @param string $token The JWT
     *
     * @throws InvalidArgumentException
     *
     * @return Token The parsed token
     */
    public function createParsedToken(string $token): Token
    {
        return (new Parser())->parse($token);
    }

    /**
     * Validate the access token.
     *
     * @param string $accessToken The JWT
     *
     * @return bool The status
     */
    public function validateToken(string $accessToken): bool
    {
        $token = $this->createParsedToken($accessToken);

        if (!$token->verify($this->signer, $this->publicKey)) {
            // Token signature is not valid
            return false;
        }

        // Check whether the token has not expired
        $data = new ValidationData();
        $data->setCurrentTime(Chronos::now()->getTimestamp());
        $data->setIssuer($token->getClaim('iss'));
        $data->setId($token->getClaim('jti'));

        return $token->validate($data);
    }

}
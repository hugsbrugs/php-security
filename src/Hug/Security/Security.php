<?php

namespace Hug\Security;

/**
 *
 */
class Security
{
    /**
     * Build a payload
     *
     * @param string $uid
     * @param string $role
     * @param bool $demo default false
     *
     * @return array $payload;
     */
    public static function get_payload($url, $uid, $role, $demo = false)
    {
        // payload defaults        
        $issuedAt   = time();
        $notBefore  = $issuedAt + 1; // Adding 10 seconds
        $expire     = $notBefore + 60*60*24;  // Adding 24 hours

        $payload = [
            'iat'  => $issuedAt, // Issued at: time when the token was generated (ex : 1356999524 )
            'nbf' => $notBefore, // Not before (ex : 1357000000)
            'exp'  => $expire, // Expire // time() + JWT::$leeway + 20,
            'iss' => $url, // A string containing the name or identifier of the issuer application. Can be a domain name and can be used to discard tokens from other applications.
            'aud' => $url, 
            'data' =>[
                'uid' => $uid,
                'role' => $role,
                'demo' => $demo,
            ]
        ];

        return $payload;
    }

}

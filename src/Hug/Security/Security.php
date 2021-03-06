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


    /**
     *
     */
    public static function clean_input($input)
    {

      $search = array(
        '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
        '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
        '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
        '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
      );

        $output = preg_replace($search, '', $input);
        return $output;
    }

    /**
     *
     */
    public static function sanitize($input)
    {
        if (is_array($input))
        {
            foreach($input as $var=>$val)
            {
                $output[$var] = Security::sanitize($val);
            }
        }
        else
        {
            if (get_magic_quotes_gpc())
            {
                $input = stripslashes($input);
            }
            # BEFORE PDO
            /*$input  = clean_input($input);
            $output = mysql_real_escape_string($input);*/
            # AFTER PDO (http://php.net/manual/en/pdo.quote.php)
            $output  = Security::clean_input($input);
        }
        return $output;
    }

    /**
     * Generates more or less complex passwords
     *
     * Generates a password containing non-accented letters (uppercase and lowercase) and digits and special characters (-=~!$^*()_<>?;[]{}|)
     * USE option simple=true for FTP passwords since some special chars make FTP connection fucked up !
     *
     * @param int $length Password length (default 15)
     *
     * @return string $password password
     *
     */
    public static function password($length = 15, $simple = false)
    {
        $password = false;
        if(is_integer($length) && $length>6)
        {
            # Default chars for complex passwords
            $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.'0123456789-=~!$^*()_<>?;[]{}|';
            
            if($simple)
            {
                $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            }

            $password = '';
            $max = strlen($chars) - 1;

            for ($i=0; $i < $length; $i++)
            {
                $password .= $chars[mt_rand(0, $max)];
            }
        }
        return $password;
    }
    
}

## php-security

```
composer require hugsbrugs/php-security
```

Load Proxies for first Time
```
require_once __DIR__ . '/../vendor/autoload.php';
use Hug\Security\Security as Security;

Security::get_payload($url, $uid, $role, $demo = false);
```


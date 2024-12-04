# microsoft-identity-auth

```php

<?php

use Zk2\MicrosoftIdentityAuth\MicrosoftIdentityAuth\IdentUser;

require __DIR__.'/vendor/autoload.php';

$identifier = new IdentUser(
    '4956mb27-45h7-451d-5690-c093n1803af7',
    'vfgj8~bg5-D8nMznk5cvby7PnBuaBTAauOTstgnm',
    'http://localhost'
);
$code = "M.C567_SN1.7.U.90e9c33d-da8a-469d-9f90-373e05585009";
print_r($identifier->identifyUser($code));

Array
(
    [id] => 5676dcfa56c36e34
    [email] => user@hotmail.com
)

```

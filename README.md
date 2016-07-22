# Memsource API PHP client

See http://wiki.memsource.com/wiki/Memsource_API for API documentation.

## Usage

Background information from the Memsource documentation:

> Before calling any API that requires an authenticated user, you have to call
> [auth/login](http://wiki.memsource.com/wiki/Authentication_API_v3) API to
> obtain an authentication token. Such a token is valid for 24 hours and can be
> used for all subsequent calls (please, do not acquire a new token for every
> call).

http://wiki.memsource.com/wiki/Memsource_API#Authentication

### Scenario 1: Token is not available

Provide a user name and a password to `Memsource` constructor. An
authentication attempt is done automatically. On success, a new `Memsource`
instance is returned. An exception is thrown on failure. The response content
is included in the exception message.

```php
use Memsource\Memsource;

try {
  $memsource = new Memsource('username', 'password');
} catch (Exception $e) {
  echo $e->getMessage();
}
```

### Scenario 2: Token is available

After successful authentication the token can be retrieved by calling
`getToken()`. The token is valid for 24 hours and new one should be acquired
only after the current one is not valid anymore. Store the token somewhere safe
and use it when constructing a new `Memsource` instance to avoid unnecessary
authentication calls.

```php
use Memsource\Memsource;

$token = get_token_from_your_token_storage();

if (isset($token) {
  $memsource = new Memsource(NULL, NULL, $token);
}
```

### After successful instantiation

After successfully constructing a new `Memsource` instance, one can call
functions on it. All functions return an instance of
`Symfony\Component\HttpFoundation\JsonResponse`.

```php
/** @var $response Symfony\Component\HttpFoundation\JsonResponse */
$json_response = $memsource->whoAmI();

$response_content = $response->getContent();

echo $response_content;
```

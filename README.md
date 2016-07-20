# Memsource API PHP client

See http://wiki.memsource.com/wiki/Memsource_API for API documentation.

## Usage

```php
use Memsource\Memsource;

$memsource = new Memsource();

/** @var $response Symfony\Component\HttpFoundation\JsonResponse */
$response = $memsource->login('username', 'password');

$response_content = $response->getContent();

echo $response_content;
```


```javascript
{
  "user": {
    "deleted": false,
    "active": true,
    "userName": "user@example.com",
    "firstName": "First",
    "id": 123,
    "lastName": "Last",
    "role": "ADMIN",
    "email": "user@example.com"
  },
  "token": "token123",
  "expires": "2016-07-21T11:38:27+0000"
}
```

```php
$response_content_as_object = json_decode($response_content);

$token = $response_content_as_object->token;

echo $memsource->whoAmI($token)->getContent();
```

```javascript
{
  "user": {
    "deleted": false,
    "active": true,
    "userName": "user@example.com",
    "firstName": "First",
    "id": 123,
    "lastName": "Last",
    "role": "ADMIN",
    "email": "user@example.com"
  },
  "csrfToken": null,
  "organization": {
    "name": "Example organization",
    "logo": null
  }
}
```

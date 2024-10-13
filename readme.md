# Simple Database
With this class structure you can easily manage your databases.

Model Example
```php
<?php
use Umityatarkalkmaz\Model;

class user extends Model{
    public function user($username)
    {
        return $this->table('user')->where('username', $username)->limit(1)->first();
    }
    public function deleteUser($id)
    {
        return $this->delete('user')->where('id', $id)->execute();
    }

    public function addUser($name, $pass)
    {
        return $this->insert('user', ['username' => $name, 'password' => $pass])->execute();
    }
    public function updateUser($name, $pass, $id)
    {
        return $this->update('user', ['username' => $name, 'password' => $pass])->where('id', $id)->execute();
    }
}
```
Model Usage Example

```php
$users = new user();
$user = $users->user('umityatarkalkmaz');
var_dump($user);
```

Model Simple Usage Example

```php
$database = new model();
$user = $database->table('user')->where('username', $username)->limit(1)->first();;
var_dump($user);
```
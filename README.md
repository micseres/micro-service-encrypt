# Micro Service OpenSSL Encrypt/Decrypt

## Usage

```php
$this->encrypt = new OpenSSLEncrypt('CAMELLIA-256-CFB');
//or $this->encrypt = new DummyEncrypt(); to do nothing

$this->encrypt->setPassword($this->bobDH->getSharedKey($alicePublickKey));

$secure = $this->encrypt->encrypt($request);
$plain = $this->encrypt->decrypt($request);
```

## License

The Soft Deletable Bundle is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

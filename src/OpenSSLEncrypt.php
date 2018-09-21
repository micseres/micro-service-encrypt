<?php
/**
 * Created by PhpStorm.
 * User: zogxray
 * Date: 20.09.18
 * Time: 12:37
 */

namespace Micseres\MicroServiceEncrypt;

use Micseres\MicroServiceEncrypt\Exception\EncryptException;

/**
 * Class OpenSSLEncrypt
 * @package Micseres\MicroServiceReactor
 */
final class OpenSSLEncrypt implements EncryptInterface
{
    /** @var string */
    private $algorithm;

    /** @var string */
    private $password;

    /**
     * OpenSSLEncrypt constructor.
     * @param string $algorithm
     *
     * @throws EncryptException
     */
    public function __construct(string $algorithm)
    {
        if (false === in_array($algorithm, openssl_get_cipher_methods(true))) {
            throw new EncryptException('Algorithm no exists');
        }

        $this->algorithm = $algorithm;
    }

    /**
     * @param string $password
     * @throws EncryptException
     */
    public function setPassword(string $password): void
    {
        if (strlen($password) < 36) {
            throw new EncryptException('To short password');
        }

        $this->password = $password;
    }

    /**
     * @param string $data
     * @return string
     * @throws EncryptException
     */
    public function encrypt(string $data): string
    {
        if (null === $this->password) {
            throw new EncryptException('Set password pls');
        }

        $iv_size = openssl_cipher_iv_length($this->algorithm);

        if (false === $iv_size) {
            throw new EncryptException('OpenSSL can`t get IV size of current algorithm');
        }

        $iv = substr($this->password, 0, $iv_size);
        $secretData = openssl_encrypt($data, $this->algorithm, $this->password,  0, $iv);

        if (false === $secretData) {
            throw new EncryptException('OpenSSL can`t encrypt data');
        }

        return bin2hex($secretData);
    }

    /**
     * @param string $data
     * @return string
     * @throws EncryptException
     */
    public function decrypt(string $data): string
    {
        if (null === $this->password) {
            throw new EncryptException('Set password pls');
        }

        $iv_size = openssl_cipher_iv_length($this->algorithm);

        if (false === $iv_size) {
            throw new EncryptException('OpenSSL can`t get IV size of current algorithm');
        }

        $iv = substr($this->password, 0, $iv_size);
        $publicData = openssl_decrypt(hex2bin($data), $this->algorithm, $this->password,  0, $iv);

        if (false === $publicData) {
            throw new EncryptException('OpenSSL can`t encrypt data');
        }

        return $publicData;
    }
}
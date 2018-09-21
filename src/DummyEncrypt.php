<?php
/**
 * Created by PhpStorm.
 * User: zogxray
 * Date: 20.09.18
 * Time: 15:12
 */

namespace Micseres\MicroServiceEncrypt;

/**
 * Class DummyEncrypt
 * @package Micseres\MicroServiceEncrypt
 */
class DummyEncrypt implements EncryptInterface
{
    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {

    }

    /**
     * @param string $data
     * @return string
     */
    public function encrypt(string $data): string
    {
        return $data;
    }

    /**
     * @param string $data
     * @return string
     */
    public function decrypt(string $data): string
    {
        return $data;
    }
}
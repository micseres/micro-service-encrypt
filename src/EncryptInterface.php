<?php
/**
 * Created by PhpStorm.
 * User: zogxray
 * Date: 20.09.18
 * Time: 12:36
 */

namespace Micseres\MicroServiceEncrypt;

/**
 * Class EncryptInterface
 * @package Micseres\MicroServiceEncrypt
 */
interface EncryptInterface
{
    /**
     * @param string $password
     */
    public function setPassword(string $password): void;
    /**
     * @param string $data
     * @return string
     */
    public function encrypt(string $data): string;

    /**
     * @param string $data
     * @return string
     */
    public function decrypt(string $data): string;
}
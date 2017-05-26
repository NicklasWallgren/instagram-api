<?php

namespace NicklasW\Instagram\Requests\Support;

class SignatureSupport
{

    /**
     * @var bool The default uuid type
     */
    public const TYPE_DEFAULT = true;

    /**
     * @var bool The combined uuid type
     */
    public const TYPE_COMBINED = false;

    /**
     * @var string The signature key
     */
    protected const SIGNATURE_KEY = '5ad7d6f013666cc93c88fc8af940348bd067b68f0dce3c85122a923f4f74b251';

    /**
     * Generates a device id.
     *
     * @param string $seed
     * @return string
     */
    public static function deviceId(string $seed): string
    {
        $volatile_seed = filemtime(__DIR__);

        return 'android-' . substr(md5($seed . $volatile_seed), 16);
    }

    /**
     * Generate a signature.
     *
     * @param string $data
     * @return string
     */
    public static function signature(string $data): string
    {
        $hash = hash_hmac('sha256', $data, self::SIGNATURE_KEY);

        return 'ig_sig_key_version=' . 4 . '&signed_body=' . $hash . '.' . urlencode($data);
    }

    /**
     * Generates a universal unique identifier.
     *
     * @param bool $type The identifier type
     * @return string
     */
    public static function uuid(bool $type = self::TYPE_DEFAULT): string
    {
        $uuid = sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );

        return $type ? $uuid : str_replace('-', '', $uuid);
    }

}
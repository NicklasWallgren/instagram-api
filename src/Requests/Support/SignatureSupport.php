<?php

namespace Instagram\SDK\Requests\Support;

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
    protected const SIGNATURE_KEY = '5b39482c3a00d6c525f3722aba347fe9ecc626ae754b59c1e70c43a1f0ffdcce';

    /**
     * Generate a signature.
     *
     * @param string $data
     * @return string
     */
    public static function signature(string $data): string
    {
        $hash = hash_hmac('sha256', $data, self::SIGNATURE_KEY);

        return 'ig_sig_key_version=' . 5 . '&signed_body=' . $hash . '.' . urlencode($data);
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

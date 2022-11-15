<?php

namespace App\Services\Payment\DTO;

class ConfigDTO
{
    private int $id;
    private string $key;

    public function __construct(int $id, string $key)
    {
        $this->id = $id;
        $this->key = $key;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }
}

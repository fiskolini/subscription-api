<?php


namespace Barkyn\Domain\DTO\Customer;


class CustomerDto
{
    /**
     * @var int $discount
     */
    private int $discount;

    /**
     * @var int|null
     */
    private ?int $user_id;

    /**
     * CustomerDto constructor.
     *
     * @param int      $discount
     * @param int|null $user_id
     */
    public function __construct(int $discount, ?int $user_id = null)
    {
        $this->discount = $discount;
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getDiscount(): int
    {
        return $this->discount;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }
}

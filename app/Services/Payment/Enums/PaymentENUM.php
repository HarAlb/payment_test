<?php

namespace App\Services\Payment\Enums;

class PaymentENUM
{
    const NEW = 'new';
    const PENDING = 'pending';
    const COMPLETED = 'completed';
    const EXPIRED = 'expired';
    const REJECTED = 'rejected';

    const CREATED = 'created';
    const IN_PROGRESS = 'inprogress';
    const PAID = 'paid';

    const FIRST_STRATEGY_STATUSES = [
        self::NEW,
        self::PENDING,
        self::COMPLETED,
        self::EXPIRED,
        self::REJECTED
    ];

    const FIRST_STRATEGY_UPDATE_COUNT = 5;
    const SECOND_STRATEGY_UPDATE_COUNT = 5;

    const SECOND_STRATEGY_STATUSES = [
        self::CREATED,
        self::IN_PROGRESS,
        self::PAID,
        self::EXPIRED,
        self::REJECTED
    ];

    const STATUSES = [
        self::NEW,
        self::PENDING,
        self::COMPLETED,
        self::EXPIRED,
        self::REJECTED,
        self::CREATED,
        self::IN_PROGRESS,
        self::PAID,
    ];
}

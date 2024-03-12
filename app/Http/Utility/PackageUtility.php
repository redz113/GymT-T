<?php

namespace  App\Http\Utility;

class PackageUtility
{

    const PACKAGE_ONE_TO_ONE = 1;
    const PACKAGE_ONE_TO_TWO = 2;
    const PACKAGE_ONE_TO_THREE = 3;

    const PACKAGE_BY_DATE = 1;
    const PACKAGE_BY_MONTH = 2;
    const PACKAGE_BY_YEAR = 3;

    const PACKAGE_BY_MONDAY = 1;
    const PACKAGE_BY_TUESDAY = 2;
    const PACKAGE_BY_WEDNESDAY = 3;
    const PACKAGE_BY_THURSDAY = 4;
    const PACKAGE_BY_FRIDAY = 5;
    const PACKAGE_BY_SATURDAY = 6;
    const PACKAGE_BY_SUNDAY = 7;



    public static  $arrayPackage = [
        self::PACKAGE_ONE_TO_ONE => '1:1',
        self::PACKAGE_ONE_TO_TWO => '1:2',
        self::PACKAGE_ONE_TO_THREE => '1:3'
    ];

    public static $arrayTypePackage = [
        self::PACKAGE_BY_DATE => 'Gói theo ngày',
        self::PACKAGE_BY_MONTH => 'Gói theo tháng',
        self::PACKAGE_BY_YEAR => 'Gói theo năm'
    ];

    public static $arrayWeekday = [
        self::PACKAGE_BY_MONDAY => 'Monday',
        self::PACKAGE_BY_TUESDAY => 'Tuesday',
        self::PACKAGE_BY_WEDNESDAY => 'Wednesday',
        self::PACKAGE_BY_THURSDAY => 'Thursday',
        self::PACKAGE_BY_FRIDAY => 'Friday',
        self::PACKAGE_BY_SATURDAY => 'Saturday',
        self::PACKAGE_BY_SUNDAY => 'Sunday',

    ];
}

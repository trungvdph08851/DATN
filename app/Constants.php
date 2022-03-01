<?php

/*status booking*/
define('BOOKING_PENDING', 0); /*Chờ xác nhận */
define('BOOKING_ACCEPTED', 1); /*Chờ xếp lịch */
define('BOOKING_SCHEDULED', 2); /*Chờ khám */
define('BOOKING_REJECTED', 3); /*Hủy */
define('BOOKING_FINISHED', 4); /*Hoàn thành */

// status booking services
define('BOOKING_SERVICES_ACCEPTED', 5);   /*Chờ xếp lịch */
define('BOOKING_SERVICES_SCHEDULED', 6);  /*Đã xếp */
define('BOOKING_SERVICES_REFRESH', 7);    /*Xếp lại */
define('BOOKING_SERVICES_FINISHED', 8);    /*Xếp lại */

// STATUS BOOKING SCHEDULE
define('BOOKING_SCHEDULE_SCHEDULED', 9);    /*Chờ khám */
define('BOOKING_SCHEDULE_FINISHED', 10);    /*Đã khám */

$statusLogin = [
    ['id' => 0, 'name' => "Nhân viên"],
    ['id' => 1, 'name' => "admin"],
    ['id' => 2, 'name' => "Bác sĩ"]
];
define('statusLogin', $statusLogin);    /*Đã khám */

?>
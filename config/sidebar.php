<?php

return [
    [
        'label' => 'Employees',
        'icon' => 'mdi:account-group-outline',
        'route' => 'employees.index',
        'permission' => 'view employees',
    ],
    [
        'label' => 'Recruitment',
        'icon' => 'mdi:briefcase-account-outline',
        'route' => 'vacancies.index',
        'roles' => ['super admin', 'hr manager', 'hr staff'],
    ],
    [
        'label' => 'Email',
        'icon' => 'mage:email',
        'permission' => 'access email',
        'route' => '#',
    ],
    [
        'label' => 'Chat',
        'icon' => 'bi:chat-dots',
        'permission' => 'access chat',
        'route' => '#',
    ],
    [
        'label' => 'Calendar',
        'icon' => 'solar:calendar-outline',
        'permission' => 'access calendar',
        'route' => '#',
    ],
];

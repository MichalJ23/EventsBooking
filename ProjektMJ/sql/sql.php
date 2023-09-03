<?php
$create[] = "CREATE TABLE `events` (
    `id` int(11) NOT NULL,
    `title` varchar(255) NOT NULL,
    `description` text NOT NULL,
    `date` datetime NOT NULL,
    `isActive` tinyint(1) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";



$create[] .= "CREATE TABLE `participants` (
    `id` int(255) NOT NULL,
    `first_name` varchar(255) NOT NULL,
    `last_name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `gender` varchar(9) NOT NULL,
    `event_id` int(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

$create[] .= "CREATE TABLE `users` (
    `id` int(11) NOT NULL,
    `login` varchar(100) NOT NULL,
    `password` varchar(100) NOT NULL,
    `name` varchar(100) NOT NULL,
    `isAdmin` tinyint(1) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";



$create[] .= "ALTER TABLE `events`
ADD PRIMARY KEY (`id`);";
$create[] .= "ALTER TABLE `participants`
ADD PRIMARY KEY (`id`);";
$create[] .= "ALTER TABLE `users`
ADD PRIMARY KEY (`id`);";

$create[] .= "ALTER TABLE `events`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;";
$create[] .= "ALTER TABLE `participants`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;";
$create[] .= "ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";
$create[] .= "COMMIT;";

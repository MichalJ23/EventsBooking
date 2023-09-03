<?php
$insert = array();
$insert[] = "INSERT INTO `events` (`id`, `title`, `description`,`date`, `isActive`) VALUES
(21, 'Gala absolwentów XIX LO Łódź', 'Łódź, Pryncypalna 31','2023-08-24 15:30:00', 1),
(22, 'Zakończenie sezonu klubu SKS Start Łódź', 'Łódź','2023-08-03 11:30:00', 1),
(23, 'Mecz koszykówki SKS-KKS Warszawa', 'Warszawa','2023-08-01 12:30:00', 0);";

$insert[] = "INSERT INTO `participants` (`id`, `first_name`, `last_name`, `email`, `gender`, `event_id`) VALUES
(38, 'Paweł', 'Pawłowski', 'pawel@gmail.com', 'Mężczyzna', 21),
(40, 'Michał', 'Paweł', 'michal@gmail.com', 'Mężczyzna', 22),
(41, 'Kowal', 'Kowalczyk', 'kowal@gmail.com', 'Mężczyzna', 22);";

<?php

define('GIGASECOND_IN_S', pow(10, 9));

function from(DateTimeImmutable $date): DateTimeImmutable
{
  return (clone $date)->add(new DateInterval("PT" . GIGASECOND_IN_S . "S"));
}

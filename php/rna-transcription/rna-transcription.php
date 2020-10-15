<?php

define("DNA_TO_RNA_MAP", ['G' => 'C', 'C' => 'G', 'T' => 'A', 'A' => 'U']);

function toRna(string $dna): string
{
  return strtr($dna, DNA_TO_RNA_MAP);
}

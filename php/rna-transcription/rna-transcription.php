<?php

define("DNA_TO_RNA_MAP", ['G' => 'C', 'C' => 'G', 'T' => 'A', 'A' => 'U']);

function toRna(string $dna): string
{
  $arr = str_split($dna);
  $rna = array_map('doCheck', $arr);
  return join('', $rna);
}

function doCheck(string $ch): string
{
  return DNA_TO_RNA_MAP[$ch];
}

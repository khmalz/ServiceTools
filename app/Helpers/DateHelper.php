<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
   /**
    * Membuat label 1/2/3 (hari/minggu/bulan/tahun) yang lalu
    */
   public static function getActivityDateLabel(string|Carbon $date): string
   {
      if (is_string($date)) {
         $date = Carbon::createFromFormat('d-m-Y', $date);
      }

      $date = $date->startOfDay();
      $diffInDays = $date->diffInDays(now()->startOfDay());
      $label = null;

      $label = ($diffInDays === 0) ? 'Today' : $date->diffForHumans();

      return $label;
   }
}

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
      $diffInDays = (int) $date->diffInDays(now()->startOfDay());

      if ($diffInDays <= 3) {
         return 'Terbaru';
      } elseif ($diffInDays <= 7) {
         return '7 Hari Terakhir';
      } elseif ($diffInDays <= 30) {
         return '1 Bulan Terakhir';
      } else {
         return 'Lebih Lama';
      }
   }
}

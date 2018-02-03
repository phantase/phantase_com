<?php

function nl2br_save_html($string)
{
  if(! preg_match("#</.*>#", $string)) // avoid looping if no tags in the string.
    return nl2br($string);

  $string = str_replace(array("\r\n", "\r", "\n"), "\n", $string);

  $lines=explode("\n", $string);
  $output='';
  foreach($lines as $line)
  {
    $line = rtrim($line);
    if(! preg_match("#</?[^/<>]*>$#", $line)) // See if the line finished with has an html opening or closing tag
      $line .= '<br />';
    $output .= $line . "\n";
  }

  return $output;
}
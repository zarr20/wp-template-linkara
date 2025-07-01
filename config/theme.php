<?php

function base_path($path = '')
{
  return get_template_directory() . '/' . ltrim($path, '/');
}

<?php

namespace Database\Interfaces;

interface RequestInterface{
  /**
   * Execute the request with some parameters
   * @param  ?array $parameters Parameters for the Request
   * @return bool               Success or not
   */
  public function execute(?array $parameters):bool;
}

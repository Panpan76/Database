<?php

namespace Database\Interfaces;

interface DatabaseInterface{
  /**
   * Create a new request given by the input string
   * @param  string             $request  Request that must be prepare
   * @return \Database\Request            The request
   */
  public function prepare(string $request):\Database\Request;
}

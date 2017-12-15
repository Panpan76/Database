<?php

namespace Database;

use \Database\Interfaces\RequestInterface;

/**
 * This class allow use to use Request on the database
 *
 * When we create a request, we must specify the request as a string
 * The request can contains some joker that will be change dynamically to parameters
 *
 * Later, we could execute the request (with some parameters if it's need)
 *    -> throw an exception if it needs it but none was given
 *
 * When the request is executed, we must return if it was a success or not
 * We must take the results of request (as exemple, a select request) and give some methods to use the results
 */
class Request implements RequestInterface{

}

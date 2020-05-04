<?php 

namespace Source\Controllers;

use Source\Models\App\ApiUser;

require __DIR__.'/../../vendor/autoload.php';
require __DIR__.'/../Config.php';

switch ($_SERVER['REQUEST_METHOD'])
{
    case 'POST':
        ApiUser::post();
    break;
    case 'GET':
        ApiUser::get();
    break;
    case 'PUT':
        ApiUser::put();
    case 'DELETE':
        ApiUser::delete();
    break;   
    default:
    ApiUser::getDefault();
        break;
}





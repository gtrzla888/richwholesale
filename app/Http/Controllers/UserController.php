<?php
/**
 * Created by PhpStorm.
 * User: Lixing
 * Date: 2019-04-15
 * Time: 19:16
 */

namespace App\Http\Controllers;


class UserController
{
    public function index()
    {
        return request()->user();
    }
}

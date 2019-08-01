<?php


namespace App\Http\Clients;


interface MdbClientContract
{
    function getCurlOpts() : array;
    public function isSucessfull() : bool;

}

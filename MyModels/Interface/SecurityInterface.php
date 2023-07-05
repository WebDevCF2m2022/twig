<?php

namespace MyModels\Interface;

interface SecurityInterface
{
    function checkSecurity($role);

    function verifyPassword($password, $hash):bool;

    function cryptPassword($password):string;
}
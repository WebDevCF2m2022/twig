<?php

namespace MyModels\Interface;

use PDO;

interface ManagerInterface{
    public function __construct(PDO $db);
}
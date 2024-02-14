<?php

namespace Core;

enum Response: int
{
    case NOT_FOUND = 404;
    case FORBIDDEN = 403;
}
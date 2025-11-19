<?php

namespace App;

enum BlogStatusEnum : string
{
    case Draft = 'draft';
    case Published = 'published';
    case InActive = 'inactive';
}

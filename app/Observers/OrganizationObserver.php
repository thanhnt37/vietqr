<?php

namespace App\Observers;

use App\Organization;

class OrganizationObserver
{
    public function created(Organization $organization)
    {
        $organization->generateQrcode();
    }
}
<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('app:about-dats', function (): void {
    $this->info('Digital Attachment Tracking System starter project');
})->purpose('Display project information');

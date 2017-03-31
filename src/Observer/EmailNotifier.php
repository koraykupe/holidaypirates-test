<?php
namespace JobBoard\Observer;

class EmailNotifier implements Observer
{
    public function handle()
    {
        // Send email here
        var_dump('Mail sent');
    }
}
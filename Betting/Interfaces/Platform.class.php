<?php
namespace Betting\Interfaces;

interface Platform
{
    public function stake();
    public function winLose();
    public function reconcile();
}
